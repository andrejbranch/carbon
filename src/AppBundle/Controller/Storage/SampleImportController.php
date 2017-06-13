<?php

namespace AppBundle\Controller\Storage;

use AppBundle\Entity\Storage\Sample;
use AppBundle\Service\Import\CryoblockDoctrineWriter;
use Carbon\ApiBundle\Controller\CarbonApiController;

use Ddeboer\DataImport\Filter\ValidatorFilter;
use Ddeboer\DataImport\Filter\CallbackFilter;
use Ddeboer\DataImport\ItemConverter\MappingItemConverter;
use Ddeboer\DataImport\ItemConverter\CallbackItemConverter;
use Ddeboer\DataImport\ValueConverter\StringToDateTimeValueConverter;
use Ddeboer\DataImport\ValueConverter\StringToObjectConverter;
use Ddeboer\DataImport\Reader\ExcelReader;
use Ddeboer\DataImport\Workflow;

use Doctrine\ORM\Query\Expr\Join;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\NotFoundHttpException;
use Symfony\Component\Validator\Constraints as Assert;
use Carbon\ApiBundle\Validator\Constraints as CarbonAssert;

use AppBundle\Validator\Constraints as ScrippsAssert;

class SampleImportController extends CarbonApiController
{
    /**
     * @Route("/storage/sample-import/{sampleTypeId}", name="sample_import_download")
     * @Method("GET")
     *
     * @return Response
     */
    public function downloadTemplateAction($sampleTypeId)
    {
        $sampleType = $this->getEntityManager()->getRepository('AppBundle:Storage\SampleType')->find($sampleTypeId);

        $importer = $this->container->get('sample.importer');

        $fileName = $sampleType->getName() . ' Import Template.csv';

        $content = $importer->getTemplateContent($sampleType);

        $response = new Response();
        $response->headers->set('Content-Type', 'application/csv');
        $response->headers->set('Content-Disposition', 'attachment; filename="'.$fileName.'";');
        // $response->headers->set('Content-Length', filesize($filename));

        $response->setContent($content);

        return $response;
    }

    /**
     * @Route("/storage/sample-import/save", name="sample_import_save")
     * @Method("POST")
     *
     * @return Response
     */
    public function saveAction()
    {
        $request = $this->getRequest();
        $data = json_decode($request->getContent(), true);

        foreach ($data as $item) {

            $entity = new Sample();

            $form = $this->createForm('sample', $entity);
            $form->submit($item);

            if (!$form->isValid()) {

                return $this->getFormErrorResponse($form);

            }

            $this->getEntityManager()->persist($entity);

        }

        $this->getEntityManager()->flush();

        return $this->getJsonResponse(json_encode(array('success' => 'success')));
    }

    /**
     * @Route("/storage/sample-import/{sampleTypeId}", name="sample_import_upload")
     * @Method("POST")
     *
     * @return Response
     */
    public function uploadAction($sampleTypeId)
    {
        $sampleType = $this->getEntityManager()->getRepository('AppBundle:Storage\SampleType')->find($sampleTypeId);

        $converter = new MappingItemConverter();

        $importer = $this->container->get('sample.importer');

        $mapping = $importer->getMapping($sampleType);

        foreach ($mapping as $columnHeader => $columnMap) {

            $converter->addMapping($columnHeader, $columnMap['prop']);

        }

        $storageContainerRepository = $this->getEntityManager()->getRepository('AppBundle:Storage\StorageContainer');
        $storageContainerConverter = new StringToObjectConverter($storageContainerRepository, 'name');

        $sampleTypeRepository = $this->getEntityManager()->getRepository('AppBundle:Storage\SampleType');
        $sampleTypeConverter = new StringToObjectConverter($sampleTypeRepository, 'name');

        $divisionRepository = $this->getEntityManager()->getRepository('AppBundle:Storage\Division');
        $divisionConverter = new StringToObjectConverter($divisionRepository, 'id');

        $fileContent = $this->getRequest()->getContent();

        $file = tempnam(sys_get_temp_dir(), 'sample_import');

        $o = new \SplFileObject($file, 'w+');
        $o->fwrite($fileContent);

        $filter = $importer->getFilter($sampleType);

        try {
            $excelReader = new ExcelReader($o, 0);
        } catch (\Exception $e) {
            return $this->getJsonResponse(json_encode(array('success' => false)), 400);
        }

        foreach ($excelReader->getColumnHeaders() as $header) {
            if (!array_key_exists($header, $mapping)) {
                return $this->getJsonResponse(json_encode(array('success' => false)), 400);
            }
        }

        $doctrineWriter = new CryoblockDoctrineWriter($this->getEntityManager(), 'AppBundle:Storage\Sample', null, true);
        $doctrineWriter->disableTruncate();
        $doctrineWriter->setBatchSize(PHP_INT_MAX);

        $storageLocationValidator = $this->get('app.validator.storage_location_validator');
        $data = array();
        foreach ($excelReader as $item) {

            $item = $converter->convert($item);

            $filter->filter($item);

            $data[] = $item;
        }

        $violations = $filter->getViolations();

        $hasErrors = false;

        if (count($violations)) {

            $hasErrors = true;

            foreach ($violations as $k => $violation) {
                $data[$k - 1]['errors'] = array();
                foreach ($violation as $childViolation) {

                    preg_match("/\[(.*)\]/", $childViolation->getPropertyPath(), $matches);

                    if (isset($data[$k - 1]['errors'][$matches[1]]) === false) {
                        $data[$k - 1]['errors'][$matches[1]] = array();
                    }

                    $data[$k - 1]['errors'][$matches[1]][] = $childViolation->getMessage();

                }
            }

        }

        $converters = array(
            'sampleType' => $sampleTypeConverter,
            'storageContainer' => $storageContainerConverter,
            'division' => $divisionConverter,
        );

        foreach($data as $k => $item) {

            foreach ($converters as $property => $valueConverter) {
                $item[$property] = $valueConverter->convert($item[$property]);
            }

            $errors = isset($data[$k]['errors']) ? $data[$k]['errors'] : [];

            $data[$k] = $doctrineWriter->writeItem($item);

            if (count($errors)) {
                $data[$k]->setErrors($errors);
            }

        }

        $locationDecider = $this->container->get('sample.location_decider');
        $data = $locationDecider->decideLocations($data);

        foreach($data as $k => $sample) {

            $storageLocationValidator->validate($sample, new ScrippsAssert\StorageLocation());

            if (!$hasErrors && count($sample->getErrors())) {
                $hasErrors = true;
            }

        }

        $columns = array();

        foreach ($excelReader->getColumnHeaders() as $columnHeader) {

            $columns[] = array(
                'header' => $columnHeader,
                'bindTo' => $mapping[$columnHeader]['bindTo'],
                'errorProp' => $mapping[$columnHeader]['errorProp']
            );

        }

        $responseData = array(
            'hasErrors' => $hasErrors,
            'items' => $data,
            'columns' => $columns,
        );

        return $this->getJsonResponse($this->getSerializationHelper()->serialize($responseData));

    }
}

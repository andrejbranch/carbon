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
        $fileName = 'sample_import.csv';

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
        $converter = new MappingItemConverter();

        $mapping = array(

            'Name' => array(
                'prop' => 'name',
                'bindTo' => 'name',
                'errorProp' => array('name'),
            ),
            'Description' => array(
                'prop' => 'description',
                'bindTo' => 'description',
                'errorProp' => array('description'),
            ),
            'Status' => array(
                'prop' => 'status',
                'bindTo' => 'status',
                'errorProp' => array('status'),
            ),
            'Storage Container' => array(
                'prop' => 'storageContainer',
                'bindTo' => 'storageContainer.name',
                'errorProp' => array('storageContainer'),
            ),
            'Storage Buffer' => array(
                'prop' => 'storageBuffer',
                'bindTo' => 'storageBuffer',
                'errorProp' => array('storageBuffer'),
            ),
            'Linked Samples' => array(
                'prop' => 'linkedSamples',
                'bindTo' => 'linkedSamples',
                'errorProp' => array('linkedSamples'),
            ),
            'Vector Name' => array(
                'prop' => 'vectorName',
                'bindTo' => 'vectorName',
                'errorProp' => array('vectorName'),
            ),
            'Concentration' => array(
                'prop' => 'concentration',
                'bindTo' => 'concentration',
                'errorProp' => array('concentration'),
            ),
            'Concentration Units' => array(
                'prop' => 'concentrationUnits',
                'bindTo' => 'concentrationUnits',
                'errorProp' => array('concentrationUnits'),
            ),
            'DNA Sequence' => array(
                'prop' => 'dnaSequence',
                'bindTo' => 'dnaSequence',
                'errorProp' => array('dnaSequence'),
            ),
            'Amino Acid Sequence' => array(
                'prop' => 'aminoAcidSequence',
                'bindTo' => 'aminoAcidSequence',
                'errorProp' => array('aminoAcidSequence'),
            ),
            'Total Amino Acids' => array(
                'prop' => 'aminoAcidCount',
                'bindTo' => 'aminoAcidCount',
                'errorProp' => array('aminoAcidCount'),
            ),
            'Molecular Weight' => array(
                'prop' => 'molecularWeight',
                'bindTo' => 'molecularWeight',
                'errorProp' => array('molecularWeight'),
            ),
            'Extinction Coefficient' => array(
                'prop' => 'extinctionCoefficient',
                'bindTo' => 'extinctionCoefficient',
                'errorProp' => array('extinctionCoefficient'),
            ),
            'Purification Tags' => array(
                'prop' => 'purificationTags',
                'bindTo' => 'purificationTags',
                'errorProp' => array('purificationTags'),
            ),
            'Division' => array(
                'prop' => 'division',
                'bindTo' => 'division.stringLabel',
                'errorProp' => array('division'),
            ),
            'Division Row' => array(
                'prop' => 'divisionRow',
                'bindTo' => 'divisionRow',
                'errorProp' => array('divisionRow', 'storageLocation'),
            ),
            'Division Column' => array(
                'prop' => 'divisionColumn',
                'bindTo' => 'divisionColumn',
                'errorProp' => array('divisionColumn', 'storageLocation'),
            ),
            'Sample Type' => array(
                'prop' => 'sampleType',
                'bindTo' => 'sampleType.name',
                'errorProp' => array('sampleType'),
            ),
        );

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
        // $file = 'php://memory';

        $file = tempnam(sys_get_temp_dir(), 'sample_import');

        $o = new \SplFileObject($file, 'w+');
        $o->fwrite($fileContent);


        $validator = $this->container->get('validator');

        $filter = new ValidatorFilter($validator);
        $filter->add('name', new Assert\NotBlank());
        $filter->add('description', new Assert\NotBlank(array(
            'message' => 'description can not be blank',
        )));
        $filter->add('linkedSamples', new Assert\Optional());
        $filter->add('status', new Assert\Choice(array(
            'choices' => array(
                'Available',
                'Depleted',
                'Destroyed',
                'Shipped'
            ),
            'message' => 'Invalid status {{ value }}'
        )));
        $filter->add('storageContainer', new CarbonAssert\StringToObject(array(
            'objectName' => 'storage container',
            'entity' => "AppBundle\\Entity\\Storage\\StorageContainer",
            'property' => 'name',
        )));
        $filter->add('storageBuffer', new Assert\NotBlank());
        $filter->add('vectorName', new Assert\NotBlank());
        $filter->add('concentration', new Assert\NotBlank());
        $filter->add('concentrationUnits', new Assert\Choice(array(
            'choices' => array(
                'mg/mL',
                'ng/uL',
                'Molar',
            )
        )));
        $filter->add('dnaSequence', new Assert\NotBlank(array(
            'message' => 'dnaSequence can not be blank',
        )));
        $filter->add('aminoAcidSequence', new Assert\NotBlank());
        $filter->add('aminoAcidCount', new Assert\NotBlank());
        $filter->add('molecularWeight', new Assert\NotBlank());
        $filter->add('extinctionCoefficient', new Assert\NotBlank());
        $filter->add('purificationTags', new Assert\NotBlank());
        $filter->add('sampleType', new CarbonAssert\StringToObject(array(
            'objectName' => 'sampleType',
            'entity' => "AppBundle\\Entity\\Storage\\SampleType",
            'property' => 'name',
        )));

        $filter->add('division', new Assert\Optional());
        $filter->add('divisionRow', new Assert\Optional());
        $filter->add('divisionColumn', new Assert\Optional());

        $filter->add('division', new CarbonAssert\StringToObject(array(
            'objectName' => 'division',
            'entity' => "AppBundle\\Entity\\Storage\\Division",
            'property' => 'id',
        )));
        $filter->add('divisionRow', new Assert\Regex(array(
            'pattern' => "/^[A-T]$/",
            'message' => 'The division row is invalid'
        )));
        $filter->add('divisionColumn', new Assert\Range(array('min' => 1, 'max' => 20)));

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

            // $callbackFilter->filter($item);

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

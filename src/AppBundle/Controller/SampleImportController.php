<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Sample;
use AppBundle\Service\Import\CryoblockDoctrineWriter;
use Carbon\ApiBundle\Controller\CarbonApiController;

use Ddeboer\DataImport\Filter\ValidatorFilter;
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

class SampleImportController extends CarbonApiController
{
    /**
     * @Route("/sample-import/{sampleTypeId}", name="sample_import_options")
     * @Method("OPTIONS")
     *
     * @return Response
     */
    public function optionsAction()
    {
        $response = new Response();

        $data = array('success' => 'success');

        return $this->getJsonResponse(json_encode($data));
    }

    /**
     * @Route("/sample-import/{sampleTypeId}", name="sample_import_download")
     * @Method("GET")
     *
     * @return Response
     */
    public function downloadTemplateAction($sampleTypeId)
    {
        $sampleType = $this->getEntityManager()->getRepository('AppBundle:SampleType')->find($sampleTypeId);

        $importer = $this->container->get('sample.importer');
        $fileName = 'sample_import.csv';

        $content = $importer->getTemplateContent($sampleType);

        $response = new Response();
        $response->headers->set('Content-Type', 'application/csv');
        $response->headers->set('Content-Disposition', 'attachment; filename="'.$fileName.'";');
        // $response->headers->set('Content-Length', filesize($filename));
        $response->headers->set('Access-Control-Allow-Origin', '*');
        $response->headers->set('Access-Control-Allow-Headers', '*');
        $response->headers->set('Access-Control-Expose-Headers', 'Content-Disposition');


        $response->setContent($content);

        return $response;
    }

    /**
     * @Route("/sample-import/{sampleTypeId}", name="sample_import_upload")
     * @Method("POST")
     *
     * @return Response
     */
    public function uploadAction($sampleTypeId)
    {
        $converter = new MappingItemConverter();

        $mapping = array(
            'Name' => 'name',
            'Description' => 'description',
            'Status' => 'status',
            'Storage Container' => 'storageContainer',
            'Storage Buffer' => 'storageBuffer',
            'Linked Samples' => 'linkedSamples',
            'Vector Name' => 'vectorName',
            'Concentration' => 'concentration',
            'Concentration Units' => 'concentrationUnits',
            'DNA Sequence' => 'dnaSequence',
            'Amino Acid Sequence' => 'aminoAcidSequence',
            'Total Amino Acids' => 'aminoAcidCount',
            'Molecular Weight' => 'molecularWeight',
            'Extinction Coefficient' => 'extinctionCoefficient',
            'Purification Tags' => 'purificationTags',
            'Division' => 'division',
            'Division Row' => 'divisionRow',
            'Division Column' => 'divisionColumn',
            'Sample Type' => 'sampleType',
        );

        foreach ($mapping as $columnHeader => $propertyKey) {

            $converter->addMapping($columnHeader, $propertyKey);

        }

        $storageContainerRepository = $this->getEntityManager()->getRepository('AppBundle:StorageContainer');
        $storageContainerConverter = new StringToObjectConverter($storageContainerRepository, 'name');

        $sampleTypeRepository = $this->getEntityManager()->getRepository('AppBundle:SampleType');
        $sampleTypeConverter = new StringToObjectConverter($sampleTypeRepository, 'name');

        $divisionRepository = $this->getEntityManager()->getRepository('AppBundle:Division');
        $divisionConverter = new StringToObjectConverter($divisionRepository, 'title');

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
            'entity' => "AppBundle\\Entity\\StorageContainer",
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
            'entity' => "AppBundle\\Entity\\SampleType",
            'property' => 'name',
        )));
        $filter->add('division', new Assert\Optional());
        $filter->add('divisionRow', new Assert\Optional());
        $filter->add('divisionColumn', new Assert\Optional());

        // $filter->add('division', new CarbonAssert\StringToObject(array(
        //     'objectName' => 'division',
        //     'entity' => "AppBundle\\Entity\\Division",
        //     'property' => 'title',
        // )));
        // $filter->add('divisionRow', new Assert\Regex(array(
        //     'pattern' => "/^[A-T]$/",
        //     'message' => 'The division row is invalid'
        // )));
        // $filter->add('divisionColumn', new Assert\Range(array('min' => 1, 'max' => 20)));

        $excelReader = new ExcelReader($o, 0);

        $workflow = new Workflow($excelReader);

        $doctrineWriter = new CryoblockDoctrineWriter($this->getEntityManager(), 'AppBundle:Sample', 'name', true);
        $doctrineWriter->disableTruncate();
        $doctrineWriter->setBatchSize(PHP_INT_MAX);

        // $workflow->addWriter($doctrineWriter);
        // $workflow->addItemConverter($converter);
        // // $workflow->addItemConverter($callbackConverter);
        // $workflow->addValueConverter('storageContainer', $storageContainerConverter);
        // $workflow->addValueConverter('division', $divisionConverter);
        // $workflow->addValueConverter('sampleType', $sampleTypeConverter);
        // $workflow->addFilter($filter);

        // $workflow->process();

        $data = array();
        foreach ($excelReader as $item) {

            $item = $converter->convert($item);

            $filter->filter($item);

            $data[] = $item;
        }

        $violations = $filter->getViolations();

        if (count($violations)) {

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

        $locationDecider = $this->container->get('sample.location_decider');
        $locationDecider->decideLocations($data);

        // foreach($data as $item) {

        //     foreach ($converters as $property => $valueConverter) {
        //         $item[$property] = $valueConverter->convert($item[$property]);
        //     }

        //     $doctrineWriter->writeItem($item);

        // }

        // $doctrineWriter->finish();

        $columns = array();

        foreach ($excelReader->getColumnHeaders() as $columnHeader) {

            $columns[] = array(
                'header' => $columnHeader,
                'bindTo' => $mapping[$columnHeader],
            );

        }

        $responseData = array(
            'items' => $data,
            'columns' => $columns,
        );

        return $this->getJsonResponse($this->getSerializationHelper()->serialize($responseData));

    }

}

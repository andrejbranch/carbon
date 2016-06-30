<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Sample;
use Carbon\ApiBundle\Controller\CarbonApiController;
use Doctrine\ORM\Query\Expr\Join;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\NotFoundHttpException;

use Ddeboer\DataImport\Workflow;
use Ddeboer\DataImport\Reader\CsvReader;
use Ddeboer\DataImport\Writer\DoctrineWriter;
use Ddeboer\DataImport\ItemConverter\MappingItemConverter;
use Ddeboer\DataImport\ItemConverter\CallbackItemConverter;
use Ddeboer\DataImport\ValueConverter\StringToDateTimeValueConverter;
use Ddeboer\DataImport\ValueConverter\StringToObjectConverter;
use Ddeboer\DataImport\Reader\ExcelReader;

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

        $converter
            ->addMapping('Name', 'name')
            ->addMapping('Description', 'description')
            ->addMapping('Status', 'status')
            ->addMapping('Storage Container', 'storageContainer')
            ->addMapping('Storage Buffer', 'storageBuffer')
            ->addMapping('Linked Samples', 'linkedSamples')
            ->addMapping('Vector Name', 'vectorName')
            ->addMapping('Concentration', 'concentration')
            ->addMapping('Concentration Units', 'concentrationUnits')
            ->addMapping('DNA Sequence', 'dnaSequence')
            ->addMapping('Amino Acid Sequence', 'aminoAcidSequence')
            ->addMapping('Total Amino Acids', 'aminoAcidCount')
            ->addMapping('Molecular Weight', 'molecularWeight')
            ->addMapping('Extinction Coefficient', 'extinctionCoefficient')
            ->addMapping('Purification Tags', 'purificationTags')
        ;

        $storageContainerRepository = $this->getEntityManager()->getRepository('AppBundle:StorageContainer');
        $storageContainerConverter = new StringToObjectConverter($storageContainerRepository, 'name');

        $sampleTypeRepository = $this->getEntityManager()->getRepository('AppBundle:SampleType');
        $sampleTypeConverter = new StringToObjectConverter($sampleTypeRepository, 'name');

        $callbackConverter = new CallbackItemConverter(function ($item) use($sampleTypeId) {
            $item['sampleTypeId'] = $sampleTypeId;
            $item['sampleType'] = $this->getEntityManager()->getRepository('AppBundle:SampleType')->find($sampleTypeId);
            return $item;
        });

        $fileContent = $this->getRequest()->getContent();
        // $file = 'php://memory';

        $file = tempnam(sys_get_temp_dir(), 'sample_import');

        $o = new \SplFileObject($file, 'w+');
        $o->fwrite($fileContent);

        $excelReader = new ExcelReader($o, 0);

        $workflow = new Workflow($excelReader);

        $doctrineWriter = new DoctrineWriter($this->getEntityManager(), 'AppBundle:Sample', 'name');
        $doctrineWriter->disableTruncate();

        $workflow->addWriter($doctrineWriter);
        $workflow->addItemConverter($converter);
        $workflow->addItemConverter($callbackConverter);
        $workflow->addValueConverter('storageContainer', $storageContainerConverter);
        // $workflow->addValueConverter('sampleType', $sampleTypeConverter);

        $workflow->process();

        return $this->getJsonResponse(json_encode(array('success')));

    }

}

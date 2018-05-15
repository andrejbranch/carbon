<?php

namespace AppBundle\Controller\Production;

use AppBundle\Entity\Production\ProteinRequestOutputSample;
use Carbon\ApiBundle\Controller\CarbonApiController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Carbon\ApiBundle\Serializer\Dot;

class ProteinRequestController extends CarbonApiController
{
    /**
     * @var string The namespace of the resource entity
     */
    const RESOURCE_ENTITY = "AppBundle\Entity\Production\ProteinRequest";

    /**
     * @var string The form type for this resource
     */
    const FORM_TYPE = "Protein";

    /**
     * Security config
     */
    protected $security = array(
        'GET' => array(
            'roles' => array('ROLE_USER'),
        ),
        'POST' => array(
            'roles' => array('ROLE_USER'),
        ),
        'PUT' => array(
            'roles' => array('ROLE_PROTEIN_ADMIN'),
            'allow_creator' => true,
        ),
        'DELETE' => array(
            'roles' => array('ROLE_PROTEIN_ADMIN'),
        )
    );

    /**
     * @Route("/production/protein-request", name="production_protein_request_get")
     * @Method("GET")
     *
     * @return Response
     */
    public function getAction()
    {
        return parent::handleGet();
    }

    /**
     * Handles the HTTP get request for the card entity
     *
     * @Route("/production/protein-request", name="production_protein_request_post")
     * @Method("POST")
     *
     * @return Response
     */
    public function handlePost()
    {
        return parent::handlePost();
    }

    /**
     * Handles the HTTP PUT request for the card entity
     *
     * @todo  figure out why PUT method has no request params
     * @Route("/production/protein-request", name="production_protein_request_put")
     * @Method("PUT")
     *
     * @return Response
     */
    public function handlePut()
    {
        return parent::handlePut();
    }

    // /**
    //  * @Route("/production/protein-request/{requestId}/download-input-template", name="production_protein_request_input_template_download")
    //  * @Method("GET")
    //  *
    //  * @return Response
    //  */
    // public function downloadInputTemplateAction($requestId)
    // {
    //     $proteinRequest = $this->getEntityManager()->getRepository('AppBundle:Production\ProteinRequest')->find($requestId);
    //     $proteinRequestInputSamples = $proteinRequest->getDnaRequestSamples();
    //     $proteinRequestInputSample = $proteinRequestInputSamples[0]->getSample();

    //     $importer = $this->container->get('sample.importer');

    //     $fileName = 'Protein Request ' . $requestId . ' Input Samples Template.csv';

    //     $content = $importer->getTemplateContent('Protein');
    //     $content = 'ID,' . $content;

    //     $sampleTypeMapping = $importer->getMapping('Protein');

    //     $sampleTypeMapping = array_merge(array(
    //         'ID' => array(
    //             'prop' => 'id',
    //             'bindTo' => 'id',
    //             'errorProp' => array('id'),
    //         )
    //     ), $sampleTypeMapping);

    //     foreach ($dnaRequestInputSamples as $dnaRequestInputSample) {

    //         $serializedInputSample = json_decode($this->getSerializationHelper()->serialize($dnaRequestInputSample->getSample()), true);

    //         $data = new Dot($serializedInputSample);

    //         $content .= "\n";

    //         foreach ($sampleTypeMapping as $label => $column) {

    //             $content .= $data->get($column['bindTo']) . ',';

    //         }

    //     }

    //     $response = new Response();
    //     $response->headers->set('Content-Type', 'application/csv');
    //     $response->headers->set('Content-Disposition', 'attachment; filename="'. $fileName .'";');

    //     $response->setContent($content);

    //     return $response;
    // }

    /**
     * @Route("/production/protein-request/{requestId}/download-output-template", name="production_protein_request_output_template_download")
     * @Method("POST")
     *
     * @return Response
     */
    public function downloadOutputTemplateAction($requestId)
    {
        $proteinRequest = $this->getEntityManager()->getRepository('AppBundle:Production\ProteinRequest')->find($requestId);

        $request = $this->getRequest();
        $data = json_decode($request->getContent(), true);

        $sampleCount = $data['sampleCount'];
        $catalogName = $data['catalogName'];

        $inputSamples = $proteinRequest->getInputSamples();
        $inputSample = $inputSamples[0]->getSample();

        $importer = $this->container->get('sample.importer');

        $fileName = 'Protein Request ' . $requestId . ' Template.csv';

        $sampleType = $this->getEntityManager()->getRepository('AppBundle:Storage\SampleType')->findOneByName('Protein');

        $content = $importer->getTemplateContent($sampleType);

        $count = 0;

        $sampleTypeMapping = $importer->getMapping($sampleType);

        $serializedInputSample = json_decode($this->getSerializationHelper()->serialize($inputSample), true);

        $data = new Dot($serializedInputSample);
        $nullColumns = array('division', 'divisionRow', 'divisionColumn', 'storageContainer', 'description');

        while ($count < $sampleCount) {

            $content .= "\n";

            foreach ($sampleTypeMapping as $label => $column) {

                if (in_array($column['prop'], $nullColumns)) {
                    $content .= ',';
                } else if ($label === 'Name') {
                    $content .= $catalogName . ',';
                } else if ($label === 'Sample Type') {
                    $content .= $sampleType->getName();
                } else {
                    $content .= $data->get($column['bindTo']) . ',';
                }
            }

            $count++;

        }

        $response = new Response();
        $response->headers->set('Content-Type', 'application/csv');
        $response->headers->set('Content-Disposition', 'attachment; filename="'. $fileName .'";');

        $response->setContent($content);

        return $response;
    }

    /**
     * @Route("/production/protein-request/{proteinRequest}/complete", name="production_protein_request_complete")
     * @Method("POST")
     *
     * @return Response
     */
    public function completeAction($proteinRequest)
    {
        $proteinRequest = $this->getEntityRepository()->find($proteinRequest);

        $request = $this->getRequest();
        $outputSampleIds = json_decode($request->getContent(), true);
        $em = $this->getEntityManager();

        $samples = $em->getRepository('AppBundle\Entity\Storage\Sample')->findBy(array('id' => $outputSampleIds));

        $proteinRequestOutputSamples = array();
        foreach ($samples as $sample) {
            $proteinRequestOutputSample = new ProteinRequestOutputSample();
            $proteinRequestOutputSample->setRequest($proteinRequest);
            $proteinRequestOutputSample->setSample($sample);
            $em->persist($proteinRequestOutputSample);
            $proteinRequestOutputSamples[] = $proteinRequestOutputSample;
        }

        $proteinRequest->setOutputSamples($proteinRequestOutputSamples);
        $proteinRequest->setStatus('Completed');

        $em->flush();

        return $this->getJsonResponse(json_encode(array('success' => 'success')));
    }
}

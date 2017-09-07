<?php

namespace AppBundle\Controller\Production;

use AppBundle\Entity\Production\DnaOutputSample;
use Carbon\ApiBundle\Controller\CarbonApiController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Carbon\ApiBundle\Serializer\Dot;

class PurificationRequestController extends CarbonApiController
{
    /**
     * @var string The namespace of the resource entity
     */
    const RESOURCE_ENTITY = "AppBundle\Entity\Production\PurificationRequest";

    /**
     * @var string The form type for this resource
     */
    const FORM_TYPE = "purification_request";

    /**
     * @Route("/production/purification-request", name="production_purification_request_get")
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
     * @Route("/production/purification-request", name="production_purification_request_post")
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
     * @Route("/production/purification-request", name="production_purification_request_put")
     * @Method("PUT")
     *
     * @return Response
     */
    public function handlePut()
    {
        return parent::handlePut();
    }

    // /**
    //  * @Route("/production/dna/{dnaRequestId}/download", name="production_dna_template_download")
    //  * @Method("GET")
    //  *
    //  * @return Response
    //  */
    // public function downloadTemplateAction($dnaRequestId)
    // {
    //     $dnaRequest = $this->getEntityManager()->getRepository('AppBundle:Production\DNA')->find($dnaRequestId);
    //     $inputSamples = $dnaRequest->getDnaRequestSamples();
    //     $inputSample = $inputSamples[0]->getSample();

    //     $importer = $this->container->get('sample.importer');

    //     $fileName = 'DNA Request ' . $dnaRequestId . ' Template.csv';

    //     $content = $importer->getTemplateContent($inputSample->getSampleType());

    //     $total = 5;
    //     $count = 0;

    //     $sampleTypeMapping = $importer->getMapping($inputSample->getSampleType());

    //     $serializedInputSample = json_decode($this->getSerializationHelper()->serialize($inputSample), true);

    //     $data = new Dot($serializedInputSample);

    //     while ($count < 5) {

    //         $content .= "\n";

    //         foreach ($sampleTypeMapping as $label => $column) {

    //             $content .= $data->get($column['bindTo']) . ',';
    //         }

    //         $count++;

    //     }

    //     $response = new Response();
    //     $response->headers->set('Content-Type', 'application/csv');
    //     $response->headers->set('Content-Disposition', 'attachment; filename="'. $fileName .'";');

    //     $response->setContent($content);

    //     return $response;
    // }

    // /**
    //  * @Route("/production/dna/{dnaRequestId}/complete", name="production_dna_complete")
    //  * @Method("POST")
    //  *
    //  * @return Response
    //  */
    // public function completeAction($dnaRequestId)
    // {
    //     $dnaRequest = $this->getEntityRepository()->find($dnaRequestId);

    //     $request = $this->getRequest();
    //     $outputSampleIds = json_decode($request->getContent(), true);
    //     $em = $this->getEntityManager();

    //     $samples = $em->getRepository('AppBundle\Entity\Storage\Sample')->findBy(array('id' => $outputSampleIds));

    //     foreach ($samples as $sample) {
    //         $dnaOutputSample = new DnaOutputSample();
    //         $dnaOutputSample->setDnaRequest($dnaRequest);
    //         $dnaOutputSample->setSample($sample);
    //         $em->persist($dnaOutputSample);
    //     }

    //     $dnaRequest->setStatus('Completed');

    //     $em->flush();

    //     return $this->getJsonResponse(json_encode(array('success' => 'success')));
    // }
}

<?php

namespace AppBundle\Controller\Production\Purification;

use AppBundle\Entity\Production\PurificationRequestOutputSample;
use Carbon\ApiBundle\Controller\CarbonApiController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Carbon\ApiBundle\Serializer\Dot;

class SizeExclusionPurificationRequestController extends CarbonApiController
{
    /**
     * @var string The namespace of the resource entity
     */
    const RESOURCE_ENTITY = "AppBundle\Entity\Production\Purification\SizeExclusionPurificationRequest";

    /**
     * @var string The form type for this resource
     */
    const FORM_TYPE = "SizeExclusionPurification";

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
            'roles' => array('ROLE_SEC_ADMIN'),
            'allow_creator' => true,
        ),
        'DELETE' => array(
            'roles' => array('ROLE_SEC_ADMIN'),
        )
    );

    /**
     * @Route("/production/purification/size-exclusion-purification-request", name="production_size_exclusion_purification_request_get")
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
     * @Route("/production/purification/size-exclusion-purification-request", name="production_size_exclusion_purification_request_post")
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
     * @Route("/production/purification/size-exclusion-purification-request", name="production_size_exclusion_purification_request_put")
     * @Method("PUT")
     *
     * @return Response
     */
    public function handlePut()
    {
        return parent::handlePut();
    }

    /**
     * @Route("/production/purification/size-exclusion-purification-request/{requestId}/download-output-template/{sampleCount}", name="production_size_exclusion_purification_request_output_template_download")
     * @Method("GET")
     *
     * @return Response
     */
    public function downloadOutputTemplateAction($requestId, $sampleCount)
    {
        $purificationRequest = $this->getEntityManager()->getRepository('AppBundle:Production\PurificationRequest')->find($requestId);
        $inputSamples = $purificationRequest->getInputSamples();
        $inputSample = $inputSamples[0]->getSample();

        $importer = $this->container->get('sample.importer');

        $fileName = 'Purification Request ' . $requestId . ' Template.csv';

        $content = $importer->getTemplateContent($inputSample->getSampleType());

        $count = 0;

        $sampleTypeMapping = $importer->getMapping($inputSample->getSampleType());

        $serializedInputSample = json_decode($this->getSerializationHelper()->serialize($inputSample), true);

        $data = new Dot($serializedInputSample);
        $nullColumns = array('division', 'divisionRow', 'divisionColumn', 'storageContainer');

        while ($count < $sampleCount) {

            $content .= "\n";

            foreach ($sampleTypeMapping as $label => $column) {

                if (in_array($column['prop'], $nullColumns)) {
                    $content .= ',';
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
     * @Route("/production/purification/size-exclusion-purification-request/{purificationRequestId}/complete", name="production_size_exclusion_purification_request_complete")
     * @Method("POST")
     *
     * @return Response
     */
    public function completeAction($purificationRequestId)
    {
        $purificationRequest = $this->getEntityRepository()->find($purificationRequestId);

        $request = $this->getRequest();
        $outputSampleIds = json_decode($request->getContent(), true);
        $em = $this->getEntityManager();

        $samples = $em->getRepository('AppBundle\Entity\Storage\Sample')->findBy(array('id' => $outputSampleIds));

        $purificationRequestOutputSamples = array();
        foreach ($samples as $sample) {
            $purificationRequestOutputSample = new PurificationRequestOutputSample();
            $purificationRequestOutputSample->setRequest($purificationRequest);
            $purificationRequestOutputSample->setSample($sample);
            $em->persist($purificationRequestOutputSample);
            $purificationRequestOutputSamples[] = $purificationRequestOutputSample;
        }

        $purificationRequest->setOutputSamples($purificationRequestOutputSamples);
        $purificationRequest->setStatus('Completed');

        $em->flush();

        return $this->getJsonResponse(json_encode(array('success' => 'success')));
    }
}

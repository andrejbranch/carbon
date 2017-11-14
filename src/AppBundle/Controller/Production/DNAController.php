<?php

namespace AppBundle\Controller\Production;

use AppBundle\Entity\Production\DnaRequestOutputSample;
use Carbon\ApiBundle\Controller\CarbonApiController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Carbon\ApiBundle\Serializer\Dot;

class DNAController extends CarbonApiController
{
    /**
     * @var string The namespace of the resource entity
     */
    const RESOURCE_ENTITY = "AppBundle\Entity\Production\DNA";

    /**
     * @var string The form type for this resource
     */
    const FORM_TYPE = "DNA";

    /**
     * @Route("/production/dna", name="production_dna_get")
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
     * @Route("/production/dna", name="production_dna_post")
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
     * @Route("/production/dna", name="production_dna_put")
     * @Method("PUT")
     *
     * @return Response
     */
    public function handlePut()
    {
        return parent::handlePut();
    }

    /**
     * @Route("/production/dna/{dnaRequestId}/download-input-template", name="production_dna_input_template_download")
     * @Method("GET")
     *
     * @return Response
     */
    public function downloadInputTemplateAction($dnaRequestId)
    {
        $dnaRequest = $this->getEntityManager()->getRepository('AppBundle:Production\DNA')->find($dnaRequestId);
        $dnaRequestInputSamples = $dnaRequest->getInputSamples();
        $dnaRequestInputSample = $dnaRequestInputSamples[0]->getSample();

        $importer = $this->container->get('sample.importer');

        $fileName = 'DNA Request ' . $dnaRequestId . ' Input Samples Template.csv';

        $content = $importer->getTemplateContent($dnaRequestInputSample->getSampleType());
        $content = 'ID,' . $content;

        $sampleTypeMapping = $importer->getMapping($dnaRequestInputSample->getSampleType());

        $sampleTypeMapping = array_merge(array(
            'ID' => array(
                'prop' => 'id',
                'bindTo' => 'id',
                'errorProp' => array('id'),
            )
        ), $sampleTypeMapping);

        foreach ($dnaRequestInputSamples as $dnaRequestInputSample) {

            $serializedInputSample = json_decode($this->getSerializationHelper()->serialize($dnaRequestInputSample->getSample()), true);

            $data = new Dot($serializedInputSample);

            $content .= "\n";

            foreach ($sampleTypeMapping as $label => $column) {

                $content .= $data->get($column['bindTo']) . ',';

            }

        }

        $response = new Response();
        $response->headers->set('Content-Type', 'application/csv');
        $response->headers->set('Content-Disposition', 'attachment; filename="'. $fileName .'";');

        $response->setContent($content);

        return $response;
    }

    /**
     * @Route("/production/dna/{dnaRequestId}/download-output-template/{sampleCount}", name="production_dna_output_template_download")
     * @Method("GET")
     *
     * @return Response
     */
    public function downloadOutputTemplateAction($dnaRequestId, $sampleCount)
    {
        $dnaRequest = $this->getEntityManager()->getRepository('AppBundle:Production\DNA')->find($dnaRequestId);
        $inputSamples = $dnaRequest->getInputSamples();
        $inputSample = $inputSamples[0]->getSample();

        $importer = $this->container->get('sample.importer');

        $fileName = 'DNA Request ' . $dnaRequestId . ' Template.csv';

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
     * @Route("/production/dna/{dnaRequestId}/complete", name="production_dna_complete")
     * @Method("POST")
     *
     * @return Response
     */
    public function completeAction($dnaRequestId)
    {
        $dnaRequest = $this->getEntityRepository()->find($dnaRequestId);

        $request = $this->getRequest();
        $outputSampleIds = json_decode($request->getContent(), true);
        $em = $this->getEntityManager();

        $samples = $em->getRepository('AppBundle\Entity\Storage\Sample')->findBy(array('id' => $outputSampleIds));

        $dnaOutputSamples = array();
        foreach ($samples as $sample) {
            $dnaOutputSample = new DnaRequestOutputSample();
            $dnaOutputSample->setRequest($dnaRequest);
            $dnaOutputSample->setSample($sample);
            $em->persist($dnaOutputSample);
            $dnaOutputSamples[] = $dnaOutputSample;
        }

        $dnaRequest->setOutputSamples($dnaOutputSamples);
        $dnaRequest->setStatus('Completed');

        $em->flush();

        return $this->getJsonResponse(json_encode(array('success' => 'success')));
    }
}

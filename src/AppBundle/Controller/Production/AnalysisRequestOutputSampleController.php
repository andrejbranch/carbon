<?php

namespace AppBundle\Controller\Production;

use Carbon\ApiBundle\Controller\CarbonApiController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;

class AnalysisRequestOutputSampleController extends CarbonApiController
{
    /**
     * @var string The namespace of the resource entity
     */
    const RESOURCE_ENTITY = "AppBundle\Entity\Production\AnalysisRequestOutputSample";

    protected $resourceLinkMap = array(
        'analysis-request' => array(
            'returnedEntity' => 'AppBundle\Entity\Storage\Sample',
            'joinColumn' => 'sampleId',
            'whereColumn' => 'requestId',
        ),
        'sample' => array(
            'returnedEntity' => 'AppBundle\Entity\Production\AnalysisRequest',
            'joinColumn' => 'requestId',
            'whereColumn' => 'sampleId',
        )
    );

    /**
     * @Route("/production/analysis-request-output-sample/{type}/{id}", name="analysis_request_output_sample_get")
     * @Method("GET")
     *
     * @return Response
     */
    public function getAction($type, $id)
    {
        return parent::handleMTMGet($type, $id);
    }
}

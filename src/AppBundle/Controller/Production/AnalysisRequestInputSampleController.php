<?php

namespace AppBundle\Controller\Production;

use Carbon\ApiBundle\Controller\CarbonApiController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;

class AnalysisRequestInputSampleController extends CarbonApiController
{
    /**
     * @var string The namespace of the resource entity
     */
    const RESOURCE_ENTITY = "AppBundle\Entity\Production\AnalysisRequestInputSample";

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
     * @Route("/production/analysis-request-input-sample/{type}/{id}", name="analysis_request_input_sample_get")
     * @Method("GET")
     *
     * @return Response
     */
    public function getAction($type, $id)
    {
        return parent::handleMTMGet($type, $id);
    }
}

<?php

namespace AppBundle\Controller\Production;

use Carbon\ApiBundle\Controller\CarbonApiController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;

class AnalysisRequestProjectController extends CarbonApiController
{
    /**
     * @var string The namespace of the resource entity
     */
    const RESOURCE_ENTITY = "AppBundle\Entity\Production\AnalysisRequestProject";

    protected $resourceLinkMap = array(
        'analysis-request' => array(
            'returnedEntity' => 'AppBundle\Entity\Project',
            'joinColumn' => 'projectId',
            'whereColumn' => 'analysisRequestId',
        ),
        'project' => array(
            'returnedEntity' => 'AppBundle\Entity\Production\AnalysisRequest',
            'joinColumn' => 'analysisRequestId',
            'whereColumn' => 'projectId',
        )
    );

    /**
     * @Route("/production/analysis-request-project/{type}/{id}", name="analysis_request_project_get")
     * @Method("GET")
     *
     * @return Response
     */
    public function getAction($type, $id)
    {
        return parent::handleMTMGet($type, $id);
    }
}

<?php

namespace AppBundle\Controller\Production;

use Carbon\ApiBundle\Controller\CarbonApiController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PipelineRequestController extends CarbonApiController
{
    /**
     * @var string The namespace of the resource entity
     */
    const RESOURCE_ENTITY = "AppBundle\Entity\Production\PipelineRequest";

    /**
     * @Route("/production/pipeline-request", name="production_pipeline_request_get")
     * @Method("GET")
     *
     * @return Response
     */
    public function getAction()
    {
        return parent::handleGet();
    }
}

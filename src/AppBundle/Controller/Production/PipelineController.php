<?php

namespace AppBundle\Controller\Production;

use Carbon\ApiBundle\Controller\CarbonApiController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PipelineController extends CarbonApiController
{
    /**
     * @var string The namespace of the resource entity
     */
    const RESOURCE_ENTITY = "AppBundle\Entity\Production\Pipeline";

    /**
     * @var string The form type for this resource
     */
    const FORM_TYPE = "pipeline";

    /**
     * @Route("/production/pipeline", name="pipeline_get")
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
     * @Route("/production/pipeline", name="pipeline_post")
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
     * @Route("/production/pipeline", name="pipeline_put")
     * @Method("PUT")
     *
     * @return Response
     */
    public function handlePut()
    {
        return parent::handlePut();
    }
}

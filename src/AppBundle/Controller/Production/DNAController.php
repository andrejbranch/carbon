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
}

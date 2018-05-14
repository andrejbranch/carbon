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
     * @Route("/production/dna", name="production_dna_patch")
     * @Method("PATCH")
     *
     * @return Response
     */
    public function handlePatch()
    {
        return parent::handlePatch();
    }

    /**
     * @Route("/production/dna", name="production_dna_delete")
     * @Method("DELETE")
     *
     * @return Response
     */
    public function handleDelete()
    {
        return parent::handleDelete();
    }

    /**
     * @Route("/production/dna", name="production_dna_purge")
     * @Method("PURGE")
     *
     * @return Response
     */
    public function handleRestore()
    {
        return parent::handleRestore();
    }
}

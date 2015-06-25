<?php

namespace AppBundle\Controller;

use Carbon\ApiBundle\Controller\CarbonApiController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class CardController extends CarbonApiController
{
    /**
     * @var string The namespace of the resource entity
     */
    const RESOURCE_ENTITY = "AppBundle\Entity\Card";

    /**
     * Handles the HTTP get request for the card entity
     *
     * @Route("/card", name="card_get")
     * @Method("GET")
     * @return [type] [description]
     */
    public function handleGet()
    {
        return parent::handleGet();
    }

    /**
     * Handles the HTTP get request for the card entity
     *
     * @Route("/card", name="card_post")
     * @Method("POST")
     * @return [type] [description]
     */
    public function handlePost()
    {
        return parent::handlePost();
    }

    /**
     * Handles the HTTP PUT request for the card entity
     *
     * @todo  figure out why PUT method has no request params
     * @Route("/card", name="card_put")
     * @Method("PUT")
     * @return [type] [description]
     */
    public function handlePut()
    {
        return parent::handlePut();
    }

    /**
     * Handles the HTTP DELETE request for the card entity
     *
     * @Route("/card", name="card_delete")
     * @Method("DELETE")
     * @return [type] [description]
     */
    public function handleDelete()
    {
        return parent::handleDelete();
    }
}

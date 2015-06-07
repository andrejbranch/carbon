<?php

namespace AppBundle\Controller;

use Carbon\ApiBundle\Controller\CarbonApiController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

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
     * @return [type] [description]
     */
    public function handleGet()
    {
        return parent::_handleGet();
    }
}

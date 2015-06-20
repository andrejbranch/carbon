<?php

namespace AppBundle\Controller;

use Carbon\ApiBundle\Controller\CarbonApiController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class PlayerController extends CarbonApiController
{
    /**
     * @var string The namespace of the resource entity
     */
    const RESOURCE_ENTITY = "AppBundle\Entity\Player";

    /**
     * Handles the HTTP get request for the card entity
     *
     * @Route("/player", name="player_get")
     * @return [type] [description]
     */
    public function handleGet()
    {
        return parent::handleGet();
    }
}

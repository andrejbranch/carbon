<?php

namespace AppBundle\Controller;

use Carbon\ApiBundle\Controller\CarbonApiController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class PlayerCardController extends CarbonApiController
{
    /**
     * @var string The namespace of the resource entity
     */
    const RESOURCE_ENTITY = "AppBundle\Entity\PlayerCard";

    /**
     * Handles the HTTP get request for the card entity
     *
     * @Route("/player-card", name="player_card_get")
     * @return [type] [description]
     */
    public function handleGet()
    {
        return parent::handleGet();
    }
}

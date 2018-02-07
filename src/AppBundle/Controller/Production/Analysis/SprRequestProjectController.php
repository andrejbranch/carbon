<?php

namespace AppBundle\Controller\Production\Analysis;

use Carbon\ApiBundle\Controller\CarbonApiController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;

class SprRequestProjectController extends CarbonApiController
{
    /**
     * @var string The namespace of the resource entity
     */
    const RESOURCE_ENTITY = "AppBundle\Entity\Production\Analysis\SprRequestProject";

    protected $resourceLinkMap = array(
        'spr-request' => array(
            'returnedEntity' => 'AppBundle\Entity\Project',
            'joinColumn' => 'projectId',
            'whereColumn' => 'requestId',
        ),
        'project' => array(
            'returnedEntity' => 'AppBundle\Entity\Production\Analysis\SprRequest',
            'joinColumn' => 'requestId',
            'whereColumn' => 'projectId',
        )
    );

    /**
     * @Route("/production/analysis/spr-request-project/{type}/{id}", name="production_spr_request_project_get")
     * @Method("GET")
     *
     * @return Response
     */
    public function getAction($type, $id)
    {
        return parent::handleMTMGet($type, $id);
    }
}

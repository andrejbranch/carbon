<?php

namespace AppBundle\Controller\Production;

use Carbon\ApiBundle\Controller\CarbonApiController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;

class PurificationRequestProjectController extends CarbonApiController
{
    /**
     * @var string The namespace of the resource entity
     */
    const RESOURCE_ENTITY = "AppBundle\Entity\Production\PurificationRequestProject";

    protected $resourceLinkMap = array(
        'purification-request' => array(
            'returnedEntity' => 'AppBundle\Entity\Project',
            'joinColumn' => 'projectId',
            'whereColumn' => 'purificationRequestId',
        ),
        'project' => array(
            'returnedEntity' => 'AppBundle\Entity\Production\PurificationRequest',
            'joinColumn' => 'purificationRequestId',
            'whereColumn' => 'projectId',
        )
    );

    /**
     * @Route("/production/purification-request-project/{type}/{id}", name="purification_request_project_get")
     * @Method("GET")
     *
     * @return Response
     */
    public function getAction($type, $id)
    {
        return parent::handleMTMGet($type, $id);
    }
}

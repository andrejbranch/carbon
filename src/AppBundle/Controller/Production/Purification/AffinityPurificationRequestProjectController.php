<?php

namespace AppBundle\Controller\Production\Purification;

use Carbon\ApiBundle\Controller\CarbonApiController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;

class AffinityPurificationRequestProjectController extends CarbonApiController
{
    /**
     * @var string The namespace of the resource entity
     */
    const RESOURCE_ENTITY = "AppBundle\Entity\Production\Purification\AffinityPurificationRequestProject";

    protected $resourceLinkMap = array(
        'affinity-purification-request' => array(
            'returnedEntity' => 'AppBundle\Entity\Project',
            'joinColumn' => 'projectId',
            'whereColumn' => 'purificationRequestId',
        ),
        'project' => array(
            'returnedEntity' => 'AppBundle\Entity\Production\Purification\AffinityPurificationRequest',
            'joinColumn' => 'purificationRequestId',
            'whereColumn' => 'projectId',
        )
    );

    /**
     * @Route("/production/purification/affinity-purification-request-project/{type}/{id}", name="production_affinity_purification_request_project_get")
     * @Method("GET")
     *
     * @return Response
     */
    public function getAction($type, $id)
    {
        return parent::handleMTMGet($type, $id);
    }
}

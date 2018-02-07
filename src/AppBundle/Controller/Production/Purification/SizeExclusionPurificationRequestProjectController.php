<?php

namespace AppBundle\Controller\Production\Purification;

use Carbon\ApiBundle\Controller\CarbonApiController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;

class SizeExclusionPurificationRequestProjectController extends CarbonApiController
{
    /**
     * @var string The namespace of the resource entity
     */
    const RESOURCE_ENTITY = "AppBundle\Entity\Production\Purification\SizeExclusionPurificationRequestProject";

    protected $resourceLinkMap = array(
        'size-exclusion-purification-request' => array(
            'returnedEntity' => 'AppBundle\Entity\Project',
            'joinColumn' => 'projectId',
            'whereColumn' => 'purificationRequestId',
        ),
        'project' => array(
            'returnedEntity' => 'AppBundle\Entity\Production\Purification\SizeExclusionPurificationRequest',
            'joinColumn' => 'purificationRequestId',
            'whereColumn' => 'projectId',
        )
    );

    /**
     * @Route("/production/purification/size-exclusion-purification-request-project/{type}/{id}", name="production_size_exclusion_purification_request_project_get")
     * @Method("GET")
     *
     * @return Response
     */
    public function getAction($type, $id)
    {
        return parent::handleMTMGet($type, $id);
    }
}

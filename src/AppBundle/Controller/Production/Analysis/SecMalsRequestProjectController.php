<?php

namespace AppBundle\Controller\Production\Analysis;

use Carbon\ApiBundle\Controller\CarbonApiController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;

class SecMalsRequestProjectController extends CarbonApiController
{
    /**
     * @var string The namespace of the resource entity
     */
    const RESOURCE_ENTITY = "AppBundle\Entity\Production\Analysis\SecMalsRequestProject";

    protected $resourceLinkMap = array(
        'sec-mals-request' => array(
            'returnedEntity' => 'AppBundle\Entity\Project',
            'joinColumn' => 'projectId',
            'whereColumn' => 'requestId',
        ),
        'project' => array(
            'returnedEntity' => 'AppBundle\Entity\Production\Analysis\SecMalsRequest',
            'joinColumn' => 'requestId',
            'whereColumn' => 'projectId',
        )
    );

    /**
     * @Route("/production/analysis/sec-mals-request-project/{type}/{id}", name="production_sec_mals_request_project_get")
     * @Method("GET")
     *
     * @return Response
     */
    public function getAction($type, $id)
    {
        return parent::handleMTMGet($type, $id);
    }
}

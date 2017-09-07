<?php

namespace AppBundle\Controller\Production;

use Carbon\ApiBundle\Controller\CarbonApiController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;

class ProteinRequestProjectController extends CarbonApiController
{
    /**
     * @var string The namespace of the resource entity
     */
    const RESOURCE_ENTITY = "AppBundle\Entity\Production\ProteinRequestProject";

    protected $resourceLinkMap = array(
        'protein-request' => array(
            'returnedEntity' => 'AppBundle\Entity\Project',
            'joinColumn' => 'projectId',
            'whereColumn' => 'proteinRequestId',
        ),
        'project' => array(
            'returnedEntity' => 'AppBundle\Entity\Production\ProteinRequest',
            'joinColumn' => 'proteinRequestId',
            'whereColumn' => 'projectId',
        )
    );

    /**
     * @Route("/production/protein-request-project/{type}/{id}", name="protein_request_project_get")
     * @Method("GET")
     *
     * @return Response
     */
    public function getAction($type, $id)
    {
        return parent::handleMTMGet($type, $id);
    }
}

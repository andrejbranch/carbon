<?php

namespace AppBundle\Controller\Production;

use Carbon\ApiBundle\Controller\CarbonApiController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;

class DNARequestProjectController extends CarbonApiController
{
    /**
     * @var string The namespace of the resource entity
     */
    const RESOURCE_ENTITY = "AppBundle\Entity\Production\DNARequestProject";

    protected $resourceLinkMap = array(
        'dna-request' => array(
            'returnedEntity' => 'AppBundle\Entity\Project',
            'joinColumn' => 'projectId',
            'whereColumn' => 'dnaRequestId',
        ),
        'project' => array(
            'returnedEntity' => 'AppBundle\Entity\Production\DNA',
            'joinColumn' => 'dnaRequestId',
            'whereColumn' => 'projectId',
        )
    );

    /**
     * @Route("/production/dna-request-project/{type}/{id}", name="dna_request_project_get")
     * @Method("GET")
     *
     * @return Response
     */
    public function getAction($type, $id)
    {
        return parent::handleMTMGet($type, $id);
    }
}

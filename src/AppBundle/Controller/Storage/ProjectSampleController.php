<?php

namespace AppBundle\Controller\Storage;

use Carbon\ApiBundle\Controller\CarbonApiController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;

class ProjectSampleController extends CarbonApiController
{
    /**
     * @var string The namespace of the resource entity
     */
    const RESOURCE_ENTITY = "AppBundle\Entity\Storage\ProjectSample";

    protected $resourceLinkMap = array(
        'project' => array(
            'returnedEntity' => 'AppBundle\Entity\Storage\Sample',
            'joinColumn' => 'sampleId',
            'whereColumn' => 'projectId',
        ),
        'sample' => array(
            'returnedEntity' => 'AppBundle\Entity\Project',
            'joinColumn' => 'projectId',
            'whereColumn' => 'sampleId',
        ),
    );

    /**
     * @Route("/storage/project-sample/{type}/{id}", name="project_sample_get")
     * @Method("GET")
     *
     * @return Response
     */
    public function getAction($type, $id)
    {
        return parent::handleMTMGet($type, $id);
    }
}

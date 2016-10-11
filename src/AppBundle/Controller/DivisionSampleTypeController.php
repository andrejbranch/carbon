<?php

namespace AppBundle\Controller;

use Carbon\ApiBundle\Controller\CarbonApiController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;

class DivisionSampleTypeController extends CarbonApiController
{
    /**
     * @var string The namespace of the resource entity
     */
    const RESOURCE_ENTITY = "AppBundle\Entity\DivisionSampleType";

    protected $resourceLinkMap = array(
        'division' => array(
            'returnedEntity' => 'AppBundle\Entity\SampleType',
            'joinColumn' => 'sampleTypeId',
            'whereColumn' => 'divisionId',
        ),
        'sample-type' => array(
            'returnedEntity' => 'AppBundle\Entity\Division',
            'joinColumn' => 'divisionId',
            'whereColumn' => 'sampleTypeId',
        )
    );

    /**
     * @Route("/division-sample-type/{type}/{id}", name="division_sample_type_options")
     * @Method("OPTIONS")
     *
     * @return Response
     */
    public function optionsAction()
    {
        $response = new Response();

        $data = array('success' => 'success');

        return $this->getJsonResponse(json_encode($data));
    }

    /**
     * @Route("/division-sample-type/{type}/{id}", name="division_sample_type_get")
     * @Method("GET")
     *
     * @return Response
     */
    public function getAction($type, $id)
    {
        return parent::handleMTMGet($type, $id);
    }
}

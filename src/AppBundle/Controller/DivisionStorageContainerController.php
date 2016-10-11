<?php

namespace AppBundle\Controller;

use Carbon\ApiBundle\Controller\CarbonApiController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;

class DivisionStorageContainerController extends CarbonApiController
{
    /**
     * @var string The namespace of the resource entity
     */
    const RESOURCE_ENTITY = "AppBundle\Entity\DivisionStorageContainer";

    protected $resourceLinkMap = array(
        'division' => array(
            'returnedEntity' => 'AppBundle\Entity\StorageContainer',
            'joinColumn' => 'storageContainerId',
            'whereColumn' => 'divisionId',
        ),
        'storage-container' => array(
            'returnedEntity' => 'AppBundle\Entity\Division',
            'joinColumn' => 'divisionId',
            'whereColumn' => 'storageContainerId',
        )
    );

    /**
     * @Route("/division-storage-container/{type}/{id}", name="division_storage_container_options")
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
     * @Route("/division-storage-container/{type}/{id}", name="division_storage_container_get")
     * @Method("GET")
     *
     * @return Response
     */
    public function getAction($type, $id)
    {
        return parent::handleMTMGet($type, $id);
    }
}

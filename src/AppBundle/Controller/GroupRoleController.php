<?php

namespace AppBundle\Controller;

use Carbon\ApiBundle\Controller\CarbonApiController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;

class GroupRoleController extends CarbonApiController
{
    /**
     * @var string The namespace of the resource entity
     */
    const RESOURCE_ENTITY = "AppBundle\Entity\GroupRole";

    protected $resourceLinkMap = array(
        'group' => array(
            'returnedEntity' => 'AppBundle\Entity\Role',
            'joinColumn' => 'roleId',
            'whereColumn' => 'groupId',
        ),
        'role' => array(
            'returnedEntity' => 'AppBundle\Entity\Group',
            'joinColumn' => 'groupId',
            'whereColumn' => 'roleId',
        )
    );

    /**
     * @Route("/group-role/{type}/{id}", name="group_role_options")
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
     * @Route("/group-role/{type}/{id}", name="group_role_get")
     * @Method("GET")
     *
     * @return Response
     */
    public function getAction($type, $id)
    {
        return parent::handleMTMGet($type, $id);
    }
}

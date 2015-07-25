<?php

namespace AppBundle\Controller;

use Carbon\ApiBundle\Controller\CarbonApiController;
use Doctrine\ORM\EntityNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends CarbonApiController
{
    /**
     * @var string The namespace of the resource entity
     */
    const RESOURCE_ENTITY = "AppBundle\Entity\User";

    /**
     * @Route("/user", name="user_options")
     * @Method("OPTIONS")
     *
     * @return [type] [description]
     */
    public function optionsAction()
    {
        $response = new Response();

        $data = array('success' => 'success');

        return $this->getJsonResponse(json_encode($data));
    }

    /**
     * @Route("/user", name="user_get")
     * @Method("GET")
     *
     * @return [type] [description]
     */
    public function getAction()
    {
        return parent::handleGet();
    }
}

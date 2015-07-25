<?php

namespace AppBundle\Controller;

use Carbon\ApiBundle\Controller\CarbonApiController;
use Doctrine\ORM\EntityNotFoundException;
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

    /**
     * Handles the HTTP PUT request for the user entity
     *
     * @todo  figure out why PUT method has no request params
     * @Route("/user", name="user_put")
     * @Method("PUT")
     * @return [type] [description]
     */
    public function handlePut()
    {
        return parent::handlePut();
    }

    /**
     * @Route("/user/{id}", name="user_delete")
     * @Method("DELETE")
     *
     * @param $id user id
     * @return Response
     */
    public function deleteAction($id)
    {
        $em = $this->getEntityManager();
        $user = $this->getEntityRepository()->find($id);

        if (!$user) {
            throw new EntityNotFoundException(sprintf('User %s not found', $id));
        }

        if ($this->getUser()->getId() === (int) $id) {
            throw new \RuntimeException('You cannot delete yourself.');
        }

        $user->setEnabled(false);
        $em->flush();

        return $this->getJsonResponse(json_encode(array('success' => 'sucess')));
    }
}

<?php

namespace AppBundle\Controller;

use Carbon\ApiBundle\Controller\CarbonApiController;
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
        return $this->handleGet();
    }


    /**
     * @Route("/user/{id}", name="user_delete")
     * @Method("DELETE")
     *
     * @return [type] [description]
     */
    public function deleteAction($id)
    {
        // get user id from the request

        // get the entity manager out of the container
        $em = $this->getDoctrine()->getManager();

        // get entity's reposityory class
        $userId = $em->getRepository('AppBundle:User')->find($id);

        // find the user you want to deactivate
            //throw exception if not found
        if (!$userId)
        {
            throw $this->EntityNotFoundException();
        }

        else
        {
            // set user enabled = false
            $userId->setEnabled(false);
            $em->flush();

            //return a response like
            return new Repsonse(’hey nigga this bitch ass user has been deactived...good job bitch tits!’)
        }


}

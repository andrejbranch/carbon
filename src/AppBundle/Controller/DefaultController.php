<?php

namespace AppBundle\Controller;

use FOS\UserBundle\Controller\SecurityController as BaseController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class DefaultController extends BaseController
{
    /**
     * @Route("/authenticate", name="login")
     * @Method("POST")
     */
    public function authenticateAction(Request $request)
    {
        $content = json_decode($request->getContent(), true);

        $username = $content['username'];
        $password = $content['password'];

        if (!isset($username) || !isset($password)){
            throw new BadRequestHttpException("You must pass username and password fields");
        }

        $um = $this->get('fos_user.user_manager');
        $user = $um->findUserByUsernameOrEmail($username);

        if (!$user instanceof \AppBundle\Entity\CarbonUser) {
            throw new AccessDeniedHttpException("No matching user account found");
        }

        $encoder_service = $this->get('security.encoder_factory');
        $encoder = $encoder_service->getEncoder($user);
        $encoded_pass = $encoder->encodePassword($password, $user->getSalt());

        if ($encoded_pass != $user->getPassword()) {
            throw new AccessDeniedHttpException("Password does not match password on record");
        }

        $result = array('apiKey' => $user->getApiKey());

        $response = new Response(json_encode($result));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}

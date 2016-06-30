<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Sample;
use Carbon\ApiBundle\Controller\CarbonApiController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\NotFoundHttpException;

class SampleController extends CarbonApiController
{
    /**
     * @var string The namespace of the resource entity
     */
    const RESOURCE_ENTITY = "AppBundle\Entity\Sample";

    /**
     * @Route("/sample", name="sample_options")
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
     * Handles the HTTP get request for the division entity
     *
     * @Route("/sample", name="sample_get")
     * @Method("GET")
     * @return [type] [description]
     */
    public function handleGet()
    {
        return parent::handleGet();
    }

    /**
     * Handles the HTTP get request for the card entity
     *
     * @Route("/sample", name="sample_post")
     * @Method("POST")
     * @return [type] [description]
     */
    public function handlePost()
    {
        $sample = new Sample();

        $form = $this->createForm('sample', $sample);
        $form->submit(json_decode($this->getRequest()->getContent(), true));

        if (!$form->isValid()) {
            return new Response($form->getErrorsAsString(), 401);
        }

        $this->getEntityManager()->persist($sample);
        $this->getEntityManager()->flush();

        return $this->getJsonResponse($this->getSerializationHelper()->serialize($sample));
    }

    /**
     * Handles the HTTP PUT request for the card entity
     *
     * @todo  figure out why PUT method has no request params
     * @Route("/sample", name="sample_put")
     * @Method("PUT")
     * @return [type] [description]
     */
    public function handlePut()
    {
        $sampleId = $this->getRequest()->get('id');

        if (!$sampleId) {
            throw new MethodNotAllowedException('Id get parameter must be set');
        }

        $sample = $this->getEntityRepository()->find($sampleId);

        if (NULL === $sample) {
            throw new NotFoundHttpException(sprintf(
                'Sample %s not found',
                $sampleId
            ));
        }

        $form = $this->createForm('sample', $sample);
        $form->submit(json_decode($this->getRequest()->getContent(), TRUE));

        if (!$form->isValid()) {
            var_dump($form->get('storageContainer')->getViewData());
            var_dump($form->get('storageContainer')->getData());
            var_dump($form->get('storageContainer')->getErrorsAsString());

            die;
            return new Response($form->getErrorsAsString(), 401);
        }

        $this->getEntityManager()->persist($sample);
        $this->getEntityManager()->flush();

        return $this->getJsonResponse($this->getSerializationHelper()->serialize($sample));
    }

    /**
     * Handles the HTTP DELETE request for the card entity
     *
     * @Route("/sample", name="sample_delete")
     * @Method("DELETE")
     * @return [type] [description]
     */
    public function handleDelete()
    {
        return parent::handleDelete();
    }
}

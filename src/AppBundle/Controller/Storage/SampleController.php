<?php

namespace AppBundle\Controller\Storage;

use AppBundle\Entity\Sample;
use Carbon\ApiBundle\Controller\CarbonApiController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\NotFoundHttpException;

class SampleController extends CarbonApiController
{
    /**
     * @var string The namespace of the resource entity
     */
    const RESOURCE_ENTITY = "AppBundle\Entity\Storage\Sample";

    /**
     * @var string The form type for this resource
     */
    const FORM_TYPE = "sample";

    /**
     * Handles the HTTP get request for the division entity
     *
     * @Route("/storage/sample", name="sample_get")
     * @Method("GET")
     * @Security("is_granted('ROLE_USER')")
     *
     * @return Response
     */
    public function handleGet()
    {
        return parent::handleGet();
    }

    /**
     * Handles the HTTP get request for the division entity
     *
     * @Route("/storage/sample/location-match/{sampleTypeId}/{storageContainerId}", name="sample_location_match")
     * @Method("GET")
     *
     * @return Response
     */
    public function handleLocationMatch($sampleTypeId, $storageContainerId)
    {
        $data = $this->getGrid()->getResult($this->getEntityRepository());

        $sampleType = $this->getEntityManager()->getRepository('AppBundle:Storage\SampleType')->find($sampleTypeId);
        $storageContainer = $this->getEntityManager()->getRepository('AppBundle:Storage\StorageContainer')->find($storageContainerId);

        $locationDecider = $this->get('sample.location_decider');

        $matchedDivisions = $locationDecider->decideLocation($sampleType, $storageContainer);

        $serialized = $this->getSerializationHelper()->serialize($matchedDivisions);

        return $this->getJsonResponse($serialized);
    }

    /**
     * Handles the HTTP get request for the card entity
     *
     * @Route("/storage/sample", name="sample_post")
     * @Method("POST")
     *
     * @return Response
     */
    public function handlePost()
    {
        return parent::handlePost();
    }

    /**
     * Handles the HTTP PUT request for the card entity
     *
     * @todo  figure out why PUT method has no request params
     * @Route("/storage/sample", name="sample_put")
     * @Method("PUT")
     *
     * @return Response
     */
    public function handlePut()
    {
        return parent::handlePut();
    }

    /**
     * Handles the HTTP DELETE request for the card entity
     *
     * @Route("/storage/sample", name="sample_delete")
     * @Method("DELETE")
     *
     * @return Response
     */
    public function handleDelete()
    {
        return parent::handleDelete();
    }
}
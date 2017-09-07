<?php

namespace AppBundle\Controller\Production;

use Carbon\ApiBundle\Controller\CarbonApiController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;

class PurificationRequestSampleController extends CarbonApiController
{
    /**
     * @var string The namespace of the resource entity
     */
    const RESOURCE_ENTITY = "AppBundle\Entity\Production\PurificationRequestSample";

    protected $resourceLinkMap = array(
        'purification-request' => array(
            'returnedEntity' => 'AppBundle\Entity\Storage\Sample',
            'joinColumn' => 'sampleId',
            'whereColumn' => 'purificationRequestId',
        ),
        'sample' => array(
            'returnedEntity' => 'AppBundle\Entity\Production\PurificationRequest',
            'joinColumn' => 'purificationRequestId',
            'whereColumn' => 'sampleId',
        )
    );

    /**
     * @Route("/production/purification-request-sample/{type}/{id}", name="purification_request_sample_get")
     * @Method("GET")
     *
     * @return Response
     */
    public function getAction($type, $id)
    {
        return parent::handleMTMGet($type, $id);
    }
}

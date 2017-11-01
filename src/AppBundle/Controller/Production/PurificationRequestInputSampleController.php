<?php

namespace AppBundle\Controller\Production;

use Carbon\ApiBundle\Controller\CarbonApiController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;

class PurificationRequestInputSampleController extends CarbonApiController
{
    /**
     * @var string The namespace of the resource entity
     */
    const RESOURCE_ENTITY = "AppBundle\Entity\Production\PurificationRequestInputSample";

    protected $resourceLinkMap = array(
        'purification-request' => array(
            'returnedEntity' => 'AppBundle\Entity\Storage\Sample',
            'joinColumn' => 'sampleId',
            'whereColumn' => 'requestId',
        ),
        'sample' => array(
            'returnedEntity' => 'AppBundle\Entity\Production\PurificationRequest',
            'joinColumn' => 'requestId',
            'whereColumn' => 'sampleId',
        )
    );

    /**
     * @Route("/production/purification-request-input-sample/{type}/{id}", name="purification_request_input_sample_get")
     * @Method("GET")
     *
     * @return Response
     */
    public function getAction($type, $id)
    {
        return parent::handleMTMGet($type, $id);
    }
}

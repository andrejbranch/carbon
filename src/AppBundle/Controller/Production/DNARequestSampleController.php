<?php

namespace AppBundle\Controller\Production;

use Carbon\ApiBundle\Controller\CarbonApiController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;

class DNARequestSampleController extends CarbonApiController
{
    /**
     * @var string The namespace of the resource entity
     */
    const RESOURCE_ENTITY = "AppBundle\Entity\Production\DNARequestSample";

    protected $resourceLinkMap = array(
        'dna-request' => array(
            'returnedEntity' => 'AppBundle\Entity\Storage\Sample',
            'joinColumn' => 'sampleId',
            'whereColumn' => 'dnaRequestId',
        ),
        'sample' => array(
            'returnedEntity' => 'AppBundle\Entity\Production\DNA',
            'joinColumn' => 'dnaRequestId',
            'whereColumn' => 'sampleId',
        )
    );

    /**
     * @Route("/production/dna-request-sample/{type}/{id}", name="dna_request_sample_get")
     * @Method("GET")
     *
     * @return Response
     */
    public function getAction($type, $id)
    {
        return parent::handleMTMGet($type, $id);
    }
}

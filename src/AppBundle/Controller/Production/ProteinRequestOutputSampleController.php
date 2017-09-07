<?php

namespace AppBundle\Controller\Production;

use Carbon\ApiBundle\Controller\CarbonApiController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;

class ProteinRequestOutputSampleController extends CarbonApiController
{
    /**
     * @var string The namespace of the resource entity
     */
    const RESOURCE_ENTITY = "AppBundle\Entity\Production\ProteinRequestOutputSample";

    protected $resourceLinkMap = array(
        'protein-request' => array(
            'returnedEntity' => 'AppBundle\Entity\Storage\Sample',
            'joinColumn' => 'sampleId',
            'whereColumn' => 'proteinRequestId',
        ),
        'sample' => array(
            'returnedEntity' => 'AppBundle\Entity\Production\ProteinRequest',
            'joinColumn' => 'proteinRequestId',
            'whereColumn' => 'sampleId',
        )
    );

    /**
     * @Route("/production/protein-request-output-sample/{type}/{id}", name="protein_request_output_sample_get")
     * @Method("GET")
     *
     * @return Response
     */
    public function getAction($type, $id)
    {
        return parent::handleMTMGet($type, $id);
    }
}

<?php

namespace AppBundle\Controller\Storage;

use AppBundle\Entity\Sample;
use Carbon\ApiBundle\Controller\CarbonApiController;
use Doctrine\ORM\Query\Expr\Join;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\NotFoundHttpException;

class SampleLinkController extends CarbonApiController
{
    /**
     * @var string The namespace of the resource entity
     */
    const RESOURCE_ENTITY = "AppBundle\Entity\Storage\Sample";

    /**
     * Handles the HTTP get request for the division entity
     *
     * @Route("/storage/sample-linked-sample/{id}", name="sample_linked_sample_get")
     * @Method("GET")
     * @return [type] [description]
     */
    public function handleGetTest($id)
    {
        $qb = $this->getEntityManager()->createQueryBuilder();

        $qb->select(array('s'))
            ->from('AppBundle\Entity\Storage\Sample', 's')
            ->innerJoin('AppBundle\Entity\Storage\SampleLinkedSample', 'sls', Join::WITH, 'sls.childSampleId = s.id')
            ->where('sls.parentSampleId = :parentSampleId')
            ->setParameter('parentSampleId', $id)
        ;

        $results = $this->getGrid()->handleQueryFilters($qb, 's', static::RESOURCE_ENTITY);

        $serialized = $this->getSerializationHelper()->serialize($results);

        return $this->getJsonResponse($serialized);
    }

}

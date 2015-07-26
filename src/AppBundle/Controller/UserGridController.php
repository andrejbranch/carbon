<?php

namespace AppBundle\Controller;

use Carbon\ApiBundle\Controller\CarbonApiController;
use Doctrine\ORM\EntityNotFoundException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserGridController extends CarbonApiController
{
    /**
     * @var string The namespace of the resource entity
     */
    const RESOURCE_ENTITY = "AppBundle\Entity\User";

    /**
     * @Route("/user/grid", name="user_grid_options")
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
     * @Route("/user/grid", name="user_grid")
     * @Method("GET")
     *
     * @return [type] [description]
     */
    public function gridAction()
    {
        $request = $this->getRequest();

        $columns = $request->get('columns');
        $search = $request->get('search');
        $start = $request->get('start');
        $length = $request->get('length');
        $order = $request->get('order');
        $orderColumn = $columns[$order[0]['column']]['data'];
        $orderDir = $order[0]['dir'];

        $searchableColumns = array_filter($columns, function ($column) {
            return $column['searchable'] == 'true';
        });

        $repo = $this->getEntityRepository();

        $qb = $repo->createQueryBuilder($alias = 'a');

        if ($search['value'] !== '') {

            foreach ($searchableColumns as $column) {
                $paramName = 'LIKE_'.$column['data'];
                $searchExpressions[] = sprintf('%s.%s LIKE :%s', $alias, $column['data'], $paramName);
                $qb->setParameter($paramName, '%'.$search['value'].'%');
            }

            $qb->andWhere(implode(' OR ', $searchExpressions));

        }

        $qb->orderBy(sprintf('%s.%s', $alias, $orderColumn), $orderDir);

        $recordsTotal = count($qb->getQuery()->getResult());

        $qb
            ->setFirstResult($start)
            ->setMaxResults($length)
        ;

        $result = $qb->getQuery()->getResult();


        $responseData = array(
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsTotal,
            'data' => $result,
        );

        return $this->getJsonResponse($this->getSerializationHelper()->serialize($responseData));

        // $columns = $request->get('columns');

        // var_dump($columns);
        // die;

        // return parent::handleGet();
    }
}

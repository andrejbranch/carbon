<?php

namespace Carbon\ApiBundle\Grid;

use Carbon\ApiBundle\Annotation\Searchable;
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\Column;

class CarbonGrid extends Grid
{
    /**
     * Get query result using request GET parameters
     *
     * @param  EntityRepository $repo
     * @return
     */
    public function getResult(EntityRepository $repo)
    {
        $queryParams = $this->request->query->all();

        $alias = 'a';

        $qb = $repo->createQueryBuilder('a');

        foreach ($queryParams as $k => $v) {
            $qb
                ->andWhere(sprintf('%s.%s = :%s', $alias, $k, $k))
                ->setParameter($k, $v)
            ;
        }

        if ($likeSearch = $this->getLikeSearch()) {

            $searchExpressions = array();

            foreach ($this->getSearchableColumns($repo) as $columnName) {
                $paramName = 'LIKE_'.$columnName;
                $searchExpressions[] = sprintf('%s.%s LIKE :%s', $alias, $columnName, $paramName);
                $qb->setParameter($paramName, $likeSearch);
            }

            $qb->andWhere(implode(' OR ', $searchExpressions));
        }

        if ($orderBy = $this->getOrderBy()) {
            $qb->orderBy(sprintf('%s.%s', $alias, $orderBy[0]), $orderBy[1]);
        }

        $qb
            ->setFirstResult($this->getOffset())
            ->setMaxResults($this->getPerPage())
        ;

        return $qb->getQuery()->getResult();
    }

    /**
     * Get searchable columns for the entity
     *
     * @param  EntityRepository $repo
     * @return array
     */
    protected function getSearchableColumns(EntityRepository $repo)
    {
        $searchableColumns = array();
        $reflClass = new \ReflectionClass($repo->getClassName());
        $reader = new AnnotationReader();
        foreach ($reflClass->getProperties() as $property) {
            $annotations = $reader->getPropertyAnnotations($property);
            $propertyName = $property->getName();
            foreach ($annotations as $annotation) {
                if ($annotation instanceof Searchable) {
                    $searchable = $annotation;
                    $searchableColumns[] = $annotation->name;
                }
            }
        }

        return $searchableColumns;
    }
}

<?php

namespace Carbon\ApiBundle\Grid;

use Carbon\ApiBundle\Annotation\Searchable;
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\ORM\EntityRepository;

/**
 * The CarbonGrid is used to aid in building paginated
 * API responses when querying for a resource. The default
 * getResult method takes your entites repository class
 * and builds a query based on the get parameters and headers
 * sent from the request. See Carbon\ApiBundle\Grid\Grid for
 * the headers that must be sent for pagination.
 *
 * If you are not overriding the default query, use the
 * @Searchable annotation on the entity properties you want to
 * include in the like string search.
 *
 * @author Andre Jon Branchizio <andrejbranch@gmail.com>
 */
class CarbonGrid extends Grid
{
    /**
     * The default grid query for a entity. Extend
     * this class in your own grid and override this
     * method if you need to define a more complicated
     * query. i.e. a query including searching joined
     * columns
     *
     * @param  EntityRepository $repo
     * @return array
     */
    public function getResult(EntityRepository $repo)
    {
        $queryParams = $this->request->query->all();

        $qb = $repo->createQueryBuilder($alias = 'a');

        foreach ($queryParams as $k => $v) {
            $qb
                ->andWhere(sprintf('%s.%s = :%s', $alias, $k, $k))
                ->setParameter($k, $v)
            ;
        }

        // If we have a search string sent in the request header
        // add LIKE search expressions for the entity properties
        // with the searchable annotation
        if ($likeSearch = $this->getLikeSearchString()) {

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

        // used for for pagination to see how many total results there are
        // before limit and offset
        $this->setUnpaginatedTotal(count($qb->getQuery()->getResult()));

        $qb
            ->setFirstResult($this->getOffset())
            ->setMaxResults($this->getPerPage())
        ;

        $result = $qb->getQuery()->getResult();

        return $this->buildGridResponse($result);
    }

    /**
     * Get searchable columns for the entity.
     *
     * @param  EntityRepository $repo
     * @return array
     */
    protected function getSearchableColumns(EntityRepository $repo)
    {
        $searchableColumns = array();
        $reflClass = $this->getEntityReflectionClass($repo->getClassName());
        $reader = $this->getReader();
        foreach ($reflClass->getProperties() as $property) {
            $annotations = $reader->getPropertyAnnotations($property);
                foreach ($annotations as $annotation) {
                if ($annotation instanceof Searchable) {
                    $searchable = $annotation;
                    $searchableColumns[] = $annotation->name;
                }
            }
        }

        return $searchableColumns;
    }

    /**
     * Get annotation reader
     *
     * @return Doctrine\Common\Annotations\AnnotationReader
     */
    protected function getReader()
    {
        return new AnnotationReader();
    }

    /**
     * Get reflection class for the entity
     *
     * @param  string $className the entities namespace
     * @return \ReflectionClass
     */
    protected function getEntityReflectionClass($className)
    {
        return new \ReflectionClass($className);
    }
}

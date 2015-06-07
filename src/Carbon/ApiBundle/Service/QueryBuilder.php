<?php

namespace Carbon\ApiBundle\Service;

use Doctrine\ORM\EntityRepository;

/**
 * QueryBuilder automates filtering for a resource
 * based on get or post parameters from a request
 *
 * @author Andre Jon Branchizio <andrejbranch@gmail.com>
 * @version  1.01
 */
class QueryBuilder
{
    /**
     * Builds a doctrine query for a given entity
     * repository and array of parameters
     *
     * @param  EntityRepository $repo
     * @param  array            $params
     *
     * @return [type]                   [description]
     */
    public function buildQuery(EntityRepository $repo, array $params)
    {
        return $repo->findBy($params);
    }
}

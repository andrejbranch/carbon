<?php

namespace Carbon\ApiBundle\Grid;

use Doctrine\ORM\EntityRepository;

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
        return $repo->findBy(
            $this->request->query->all(),
            null,
            $this->getPerPage(),
            $this->getOffset()
        );
    }
}

<?php

namespace AppBundle\Service\Storage;

class DivisionManager
{
    protected $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }
    public function updateDivisionStats()
    {
    }
}

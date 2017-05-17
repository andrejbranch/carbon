<?php

namespace AppBundle\Listener;

use AppBundle\Entity\Storage\Division;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Bridge\Monolog\Logger;

class DivisionListener
{
    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $division = $args->getEntity();
        $em = $args->getEntityManager();

        if (($division instanceof Division) === FALSE) {
            return;
        }
        var_dump(123);
        die;

        $this->setStats($division);

        $this->setPaths($division);

        $em->persist($division);
        $em->flush();
    }

    public function postUpdate(LifecycleEventArgs $args)
    {
        $division = $args->getEntity();
        $em = $args->getEntityManager();

        if (($division instanceof Division) === FALSE) {
            return;
        }
        var_dump(4356);
        die;

        $this->setStats($division);
        $this->setPaths($division);

        $em->persist($division);
        $em->flush();
    }

    private function setStats(Division $division)
    {
        if ($division->hasDimension()) {

            $height = $division->getHeight();
            $width = $division->getHeight();
            $totalSlots = $height * $width;

            $division->setTotalSlots($totalSlots);
            $division->setUsedSlots(0);
            $division->setPercentFull(0);
            $division->setAvailableSlots($totalSlots);

        }
    }

    private function setPaths(Division $division)
    {
        $tree = array();
        $tree[] = $currentDivision = $division;

        while ($currentDivision) {

            $currentDivision = $currentDivision->getParent();

            if ($currentDivision) {
                $tree[] = $currentDivision;
            }

        }

        $path = array();
        $idPath = array();
        $tree = array_reverse($tree);

        unset($tree[0]);

        foreach ($tree as $node) {
            $path[] = $node->getTitle();
            $idPath[] = $node->getId();
        }

        $path = implode(' / ', $path);
        $idPath = ' ' . implode(' ', $idPath) . ' ';

        $division->setPath($path);
        $division->setIdPath($idPath);
    }
}

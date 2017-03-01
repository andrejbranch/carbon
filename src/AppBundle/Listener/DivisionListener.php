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

    public function postPersist(LifecycleEventArgs $args)
    {
        $division = $args->getEntity();
        $em = $args->getEntityManager();

        if (($division instanceof Division) === FALSE) {
            return;
        }

        if (!$division->hasDimension()) {
            return;
        }

        $em->persist($division);

        $height = $division->getHeight();
        $width = $division->getHeight();
        $totalSlots = $height * $width;

        $division->setTotalSlots($totalSlots);
        $division->setUsedSlots(0);
        $division->setPercentFull(0);
        $division->setAvailableSlots($totalSlots);

        $em->flush();
    }

    public function postUpdate(LifecycleEventArgs $args)
    {
        $division = $args->getEntity();
        $em = $args->getEntityManager();

        if (($division instanceof Division) === FALSE) {
            return;
        }

        if (!$division->hasDimension()) {
            return;
        }

        $em->persist($division);

        $height = $division->getHeight();
        $width = $division->getHeight();

        $totalSamples = count($division->getSamples());
        $totalSlots = $height * $width;
        $availableSlots = $totalSlots - $totalSamples;

        $division->setTotalSlots($totalSlots);
        $division->setUsedSlots($totalSamples);
        $division->setAvailableSlots($totalSlots - $totalSamples);
        $division->setPercentFull(($totalSamples / $totalSlots) * 100);

        $em->flush();
    }
}

<?php

namespace AppBundle\Listener;

use AppBundle\Entity\Sample;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Bridge\Monolog\Logger;

class SampleListener
{
    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }

    public function postPersist(LifecycleEventArgs $args)
    {
        $this->updateDivisionInventory($args);
    }

    public function postUpdate(LifecycleEventArgs $args)
    {
        $this->updateDivisionInventory($args);
    }

    private function updateDivisionInventory(LifecycleEventArgs $args)
    {
        $sample = $args->getEntity();
        $em = $args->getEntityManager();

        if (($sample instanceof Sample) === FALSE) {
            return;
        }

        $division = $sample->getDivision();

        if (!$division) {
            return;
        }

        $em->persist($division);

        if (!$division->hasDimension()) {
            return;
        }

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

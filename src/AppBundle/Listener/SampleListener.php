<?php

namespace AppBundle\Listener;

use AppBundle\Entity\Storage\Sample;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PostFlushEventArgs;
use Doctrine\ORM\Event\OnFlushEventArgs;
use Symfony\Bridge\Monolog\Logger;

class SampleListener
{
    public $divisionsToUpdate = array();

    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }

    public function postPersist(LifecycleEventArgs $args)
    {
        $this->updateDivisionInventory($args);
    }

    // public function preUpdate(LifecycleEventArgs $args)
    // {
    //     $sample = $args->getEntity();
    //     $em = $args->getEntityManager();

    //     if (($sample instanceof Sample) === FALSE) {
    //         return;
    //     }

    //     if ($args->hasChangedField('divisionId')) {
    //        $this->previousDivisionId = $args->getOldValue('divisionId');
    //     }
    // }

    public function preUpdate(LifecycleEventArgs $args)
    {
        $this->updateDivisionInventory($args);
    }

    public function postRemove(LifecycleEventArgs $args)
    {
        $this->updateDivisionInventory($args);
    }

    public function preRemove(LifecycleEventArgs $args)
    {
        $sample = $args->getEntity();
        $em = $args->getEntityManager();

        if (($sample instanceof Sample) === FALSE) {
            return;
        }

        $this->previousDivisionId = $sample->getDivisionId();
    }

    private function updateDivisionInventory(LifecycleEventArgs $args)
    {
        var_dump('here');
        die;
        $sample = $args->getEntity();
        $em = $args->getEntityManager();

        if (($sample instanceof Sample) === FALSE) {
            return;
        }

        $division = $sample->getDivision();

        if ($args->hasChangedField('divisionId')) {
           $previousDivisionId = $args->getOldValue('divisionId');
        }

        if (!$division) {

            if (!isset($previousDivisionId)) {
                return;
            }

            $division = $em->getRepository('AppBundle\Entity\Storage\Division')->find($previousDivisionId);

        }

        $this->updateDivisionId = $division->getId();

        if (!$division->hasDimension()) {
            return;
        }

        $this->divisionsToUpdate[] = $division;
        var_dump(123);
        die;
    }

    public function onFlush(OnFlushEventArgs $args)
    {
        $em = $args->getEntityManager();
        $uow = $em->getUnitOfWork();
        $divisionsToUpdate = [];
        foreach ($uow->getScheduledEntityUpdates() as $keyEntity => $entity) {

            if ($entity instanceof Sample) {

                foreach ($uow->getEntityChangeSet($entity) as $keyField => $field) {

                    if ($keyField === 'division') {

                        $oldDivision = $field[0];
                        $newDivision = $field[1];

                        if ($oldDivision) {
                            $oldDivisionId = $oldDivision->getId();
                            if (!isset($divisionsToUpdate[$oldDivisionId])) {
                                $divisionsToUpdate[$oldDivisionId] = array(
                                    'division' => $oldDivision,
                                    'removeCount' => 0,
                                    'addCount' => 0
                                );
                            }
                            $divisionsToUpdate[$oldDivisionId]['removeCount']++;
                        }

                        if ($newDivision) {
                            $newDivisionId = $newDivision->getId();
                            if (!isset($divisionsToUpdate[$newDivisionId])) {
                                $divisionsToUpdate[$newDivisionId] = array(
                                    'division' => $newDivision,
                                    'removeCount' => 0,
                                    'addCount' => 0
                                );
                            }
                            $divisionsToUpdate[$newDivisionId]['addCount']++;
                        }

                    }
                }

            }

        }

        foreach ($divisionsToUpdate as $divisionId => $map) {

            $division = $map['division'];

            $this->updateDivision($division, $map['removeCount'], $map['addCount']);

            $em->persist($division);

            $metaDivision = $em->getClassMetadata(get_class($division));
            $uow->computeChangeSet($metaDivision, $division);

        }

    }

    private function updateDivision($division, $removeCount, $addCount) {

        $height = $division->getHeight();
        $width = $division->getHeight();

        $totalSamples = count($division->getSamples()) - $removeCount + $addCount;
        $totalSlots = $height * $width;
        $availableSlots = $totalSlots - $totalSamples;

        $division->setTotalSlots($totalSlots);
        $division->setUsedSlots($totalSamples);
        $division->setAvailableSlots($totalSlots - $totalSamples);
        $division->setPercentFull(($totalSamples / $totalSlots) * 100);
    }

    public function postUpdate(LifecycleEventArgs $args)
    {
        $em = $args->getEntityManager();
        if (count($this->divisionsToUpdate)) {
            foreach ($this->divisionsToUpdate as $division) {
                $this->updateDivision($division);
                $em->persist($division);
            }
        }
        $em->flush();
    }
}

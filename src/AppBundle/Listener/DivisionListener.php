<?php

namespace AppBundle\Listener;

use AppBundle\Entity\Storage\Division;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\OnFlushEventArgs;
use Symfony\Bridge\Monolog\Logger;

class DivisionListener
{
    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }

    public function onFlush(OnFlushEventArgs $args)
    {
        // $division = $args->getEntity();
        // $em = $args->getEntityManager();

        foreach ($uow->getScheduledEntityUpdates() as $keyEntity => $entity) {
        if (($division instanceof Division) === FALSE) {
            return;
        }
        var_dump(4356);
        die;

        // $this->setStats($division);
        // $this->setPaths($division);

        // $em->persist($division);
        // $em->flush();
    }
}

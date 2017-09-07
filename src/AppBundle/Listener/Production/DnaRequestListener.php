<?php

namespace AppBundle\Listener\Production;

use AppBundle\Entity\Production\DNA;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PostFlushEventArgs;
use Doctrine\ORM\Event\OnFlushEventArgs;
use Doctrine\ORM\UnitOfWork;
use Symfony\Bridge\Monolog\Logger;

class DnaRequestListener
{
    public function __construct()
    {
    }

    public function onFlush(OnFlushEventArgs $args)
    {
        $em = $args->getEntityManager();
        $uow = $em->getUnitOfWork();

        foreach ($uow->getScheduledEntityInsertions() as $keyEntity => $entity) {

            if ($entity instanceof DNA) {

                $qb = $em->createQueryBuilder();

                $startOfMonth = new \DateTime(date('Y-m-01'));
                $endOfMonth = new \DateTime(date('Y-m-t'));

                $total = $qb
                    ->select('count(d.id)')
                    ->from('AppBundle\Entity\Production\DNA','d')
                    ->add('where', $qb->expr()->between(
                        'd.createdAt',
                        ':from',
                        ':to'
                    ))
                    ->setParameters(array(
                        'from' => $startOfMonth,
                        'to' => $endOfMonth
                    ))
                    ->getQuery()
                    ->getSingleScalarResult()
                ;

                $total = $total + 1;
                $alias = sprintf('%s%s-%s', 'D', $startOfMonth->format('my'), $total);

                $metaDna = $em->getClassMetadata(get_class($entity));

                $entity->setAlias($alias);

                $uow->recomputeSingleEntityChangeSet($metaDna, $entity);

            }

        }

    }

}

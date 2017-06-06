<?php

namespace AppBundle\Entity\Storage;

use AppBundle\Entity\Storage\Division;
use AppBundle\Entity\Storage\SampleType;
use AppBundle\Entity\Storage\StorageContainer;
use Carbon\ApiBundle\Entity\User;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\Expr\Join;
use Gedmo\Tree\Entity\Repository\NestedTreeRepository;

/**
 * ProjectRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class DivisionRepository extends NestedTreeRepository
{
    public function findMatchedDivisionsWithDimension(SampleType $sampleType, StorageContainer $storageContainer)
    {
        $qb = $this->createQueryBuilder('d');

        $qb
            ->innerJoin('d.divisionSampleTypes', 'dst')
            ->innerJoin('d.divisionStorageContainers', 'dsc')
            ->andWhere('d.hasDimension = TRUE')
            ->andWhere('dst.sampleTypeId = :sampleTypeId')
            ->andWhere('dsc.storageContainerId = :storageContainerId')
            ->setParameter('sampleTypeId', $sampleType->getId())
            ->setParameter('storageContainerId', $storageContainer->getId())
        ;

        return $qb->getQuery()->getResult();
    }

    public function findMatchedDimensionlessDivisions(SampleType $sampleType, StorageContainer $storageContainer)
    {
        $qb = $this->createQueryBuilder('d');

        $qb
            ->innerJoin('d.divisionSampleTypes', 'dst')
            ->innerJoin('d.divisionStorageContainers', 'dsc')
            ->andWhere('d.hasDimension = FALSE')
            ->andWhere('dst.sampleTypeId = :sampleTypeId')
            ->andWhere('dsc.storageContainerId = :storageContainerId')
            ->setParameter('sampleTypeId', $sampleType->getId())
            ->setParameter('storageContainerId', $storageContainer->getId())
        ;

        return $qb->getQuery()->getResult();
    }

    public function buildMatchQuery($sampleTypeId, $storageContainerId)
    {
        $qb = $this->getEntityManager()->createQueryBuilder();

        return $qb->select(array('d'))
            ->from('AppBundle\Entity\Storage\Division', 'd')

            ->innerJoin('AppBundle\Entity\Storage\DivisionSampleType', 'dsd', Join::WITH, 'dsd.divisionId = d.id')
            ->innerJoin('AppBundle\Entity\Storage\DivisionStorageContainer', 'dsc', Join::WITH, 'dsc.divisionId = d.id')

            ->where('dsd.sampleTypeId = :sampleTypeId')
            ->andWhere('dsc.storageContainerId = :storageContainerId')
            ->andWhere('d.percentFull < 100')

            ->setParameter('sampleTypeId', $sampleTypeId)
            ->setParameter('storageContainerId', $storageContainerId)

            ->orderBy('d.percentFull', 'DESC')
        ;
    }

    public function getAvailableCells(Division $division)
    {
        $width = $division->getWidth();
        $height = $division->getHeight();
        $alphabet = range('A', 'Z');

        $divisionSamples = $division->getSamples();

        $currentInventoryMap = array();
        foreach ($divisionSamples as $divisionSample) {
            $currentInventoryMap[$divisionSample->getDivisionRow()][$divisionSample->getDivisionColumn()] = true;
        }

        $rows = range('A', $alphabet[$height - 1]);
        $emptyLocations = array();
        foreach ($rows as $row) {

            foreach (range(1, $width) as $column) {

                if (!isset($currentInventoryMap[$row][$column])) {
                    if (!isset($emptyLocations[$row])) {
                        $emptyLocations[$row] = array();
                    }

                    $emptyLocations[$row][$column] = true;

                }

            }
        }

        return $emptyLocations;
    }

    public function canUserView(Division $division, User $user)
    {
        if ($division->getIsPublicEdit()) {
            return true;
        }

        if ($this->canUserEdit($division, $user)) {
            return true;
        }

        if ($division->getIsPublicView()) {
            return true;
        }

        if ($user->hasRole('ROLE_ADMIN')) {
            return true;
        }

        $qb = $this->getEntityManager()->createQueryBuilder();

        $result = $qb->select(array('dv'))

            ->from('AppBundle\Entity\Storage\DivisionViewer', 'dv')

            ->where('dv.userId = :userId')
            ->andWhere('dv.divisionId = :divisionId')

            ->setParameter('userId', $user->getId())
            ->setParameter('divisionId', $division->getId())

            ->getQuery()
            ->getResult()
        ;

        return count($result) == 1;
    }

    public function canUserEdit(Division $division, User $user)
    {
        if ($division->getIsPublicEdit()) {
            return true;
        }

        if ($user->hasRole('ROLE_ADMIN')) {
            return true;
        }

        $qb = $this->getEntityManager()->createQueryBuilder();

        $result = $qb->select(array('de'))

            ->from('AppBundle\Entity\Storage\DivisionEditor', 'de')

            ->where('de.userId = :userId')
            ->andWhere('de.divisionId = :divisionId')

            ->setParameter('userId', $user->getId())
            ->setParameter('divisionId', $division->getId())

            ->getQuery()
            ->getResult()
        ;

        return count($result) == 1;
    }
}

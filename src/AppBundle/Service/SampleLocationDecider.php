<?php

namespace AppBundle\Service;

use AppBundle\Entity\Storage\Division;
use AppBundle\Entity\Storage\SampleType;
use AppBundle\Entity\Storage\StorageContainer;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query\Expr\Join;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

class SampleLocationDecider
{
    protected $em;

    public function __construct(EntityManager $em, TokenStorage $tokenStorage)
    {
        $this->em = $em;
        $this->tokenStorage = $tokenStorage;
    }

    public function decideLocations(&$samples)
    {
        $totalSamples = count($samples);

        $selectedSampleType = $samples[0]->getSampleType();
        $selectedStorageContainer = $samples[0]->getStorageContainer();

        if (!$selectedSampleType || !$selectedStorageContainer) {
           return $samples;
        }

        $matchedDivisions = $this->getMatchedDivisions($selectedSampleType , $selectedStorageContainer, $samples);

        return $samples;

    }

    private function getMatchedDivisions(SampleType $sampleType, StorageContainer $storageContainer, &$samples)
    {
        $repo = $this->em->getRepository('AppBundle:Storage\Division');

        $user = $this->tokenStorage->getToken()->getUser();
        $qb = $repo->buildMatchQuery($sampleType->getId(), $storageContainer->getId(), $user);

        $matchedDivisions = $qb
            ->setMaxResults(100)
            ->getQuery()
            ->getResult()
        ;

        // $divisionsToBeFilled = array();
        $totalSamples = $this->countSamplesWithoutDivision($samples);
        $remainingCount = $totalSamples;

        if ($totalSamples == 0) {
           return;
        }

        $sampleIndex = 0;
        $completed = 0;

        foreach ($matchedDivisions as $matchedDivision) {

            if ($completed === $totalSamples) {

                break;

            }

            $availableSlots = $matchedDivision->getAvailableSlots();

            $remainingCount = ($availableSlots - $remainingCount) >= 0 ? 0 :  abs($availableSlots - $remainingCount);

            $emptyCells = $repo->getAvailableCells($matchedDivision);

            foreach ($emptyCells as $rowKey => $row) {

                if ($completed === $totalSamples) {

                    break;

                }

                foreach ($row as $columnKey => $column) {

                    if ($completed === ($totalSamples)) {

                        break;

                    }

                    while ($completed < $totalSamples) {

                        if (!$this->hasValidLocation($samples[$sampleIndex])) {

                            $samples[$sampleIndex]->setStorageRecommended(TRUE);
                            $samples[$sampleIndex]->setDivision($matchedDivision);
                            $samples[$sampleIndex]->setDivisionRow($rowKey);
                            $samples[$sampleIndex]->setDivisionColumn($columnKey);

                            $completed++;
                            $sampleIndex++;
                            break;
                        }

                        $sampleIndex++;

                    }

                    $remainingCount--;

                }

            }

        }

    }

    private function countSamplesWithoutDivision($samples)
    {
        $count = 0;
        foreach ($samples as $sample) {
            if (!$this->hasValidLocation($sample)) {
                $count++;
            }
        }

        return $count;
    }

    private function hasValidLocation($sample)
    {
        return $sample->getDivision() &&
            $sample->getDivisionRow() &&
            $sample->getDivisionColumn()
        ;
    }
}

<?php

namespace AppBundle\Service;

use AppBundle\Entity\Division;
use AppBundle\Entity\SampleType;
use AppBundle\Entity\StorageContainer;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query\Expr\Join;

class SampleLocationDecider
{
    protected $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function decideLocations(&$samples)
    {
        $totalSamples = count($samples);

        $selectedSampleType = $this->getSampleTypeByName($samples[0]['sampleType']);
        $selectedStorageContainer = $this->getStorageContainerByName($samples[0]['storageContainer']);


        $matchedDivisions = $this->getMatchedDivisionTest($selectedSampleType , $selectedStorageContainer, $samples);

        // foreach ($samples as &$sample) {

        //     $selectedSampleType = $this->getSampleTypeByName($sample['sampleType']);
        //     $selectedStorageContainer = $this->getStorageContainerByName($sample['storageContainer']);

        //     $match = $this->getMatchedDivision($selectedSampleType, $selectedStorageContainer);

        //     $sample['division'] = $match['division'];

        //     if (isset($match['divisionRow'])) {

        //         $sample['divisionRow'] = $match['divisionRow'];
        //     }

        //     if (isset($match['divisionColumn'])) {

        //         $sample['divisionColumn'] = $match['divisionColumn'];
        //     }
        // }

        // return $samples;

    }

    public function decideLocation(SampleType $sampleType, StorageContainer $storageContainer)
    {
        return $this->getMatchedDivision($sampleType, $storageContainer);

    }

    public function getSampleTypeByName($name)
    {
        return $this->em->getRepository('AppBundle:SampleType')->findOneBy(array('name' => $name));
    }

    public function getStorageContainerByName($name)
    {
        return $this->em->getRepository('AppBundle:StorageContainer')->findOneBy(array('name' => $name));
    }

    private function getMatchedDivisionTest(SampleType $sampleType, StorageContainer $storageContainer, &$samples)
    {
        $repo = $this->em->getRepository('AppBundle:Division');

        $matchedWithDimensions = $repo->findMatchedDivisionsWithDimension($sampleType, $storageContainer);
        $matchedDimensionless = $repo->findMatchedDimensionlessDivisions($sampleType, $storageContainer);

        $matchedDivisions = array_merge($matchedWithDimensions, $matchedDimensionless);

        // $divisionsToBeFilled = array();
        $totalSamples = count($samples);
        $remainingCount = $totalSamples;

        $sampleIndex = 0;

        foreach ($matchedDivisions as $matchedDivision) {

            if ($sampleIndex === ($totalSamples)) {

                break;

            }

            $availableSlots = $matchedDivision->getAvailableSlots();

            $remainingCount = ($availableSlots - $remainingCount) >= 0 ? 0 :  abs($availableSlots - $remainingCount);

            // $divisionsToBeFilled[] = $matchedDivision;

            $emptyCells = $this->getEmptyCells($matchedDivision);

            foreach ($emptyCells as $rowKey => $row) {

                if ($sampleIndex === ($totalSamples)) {

                    break;

                }

                foreach ($row as $columnKey => $column) {

                    if ($sampleIndex === ($totalSamples)) {

                        break;

                    }

                    $samples[$sampleIndex]['division'] = $matchedDivision->getTitle();
                    $samples[$sampleIndex]['divisionRow'] = $rowKey;
                    $samples[$sampleIndex]['divisionColumn'] = $columnKey;

                    $sampleIndex++;
                    $remainingCount--;

                }

            }

        }

        // if (count($matchedWithDimensions) !== 0) {

        //     $emptyCells = $this->getEmptyCells($matchedWithDimensions[0]);

        //     foreach ($emptyCells as $rowKey => $emptyRow) {

        //         foreach ($emptyRow as $columnKey => $emptyColumn) {

        //             return array(
        //                 'division' => $matchedWithDimensions[0],
        //                 'divisionRow' => $rowKey,
        //                 'divisionColumn' => $columnKey,
        //             );

        //         }
        //     }


        // }

        // if (count($matchedDimensionless) !== 0) {
        //     return $matchedDimensionless[0];
        // }

        // // no matches
        // return array();
    }
    private function getMatchedDivision(SampleType $sampleType, StorageContainer $storageContainer)
    {
        $repo = $this->em->getRepository('AppBundle:Division');

        $matchedWithDimensions = $repo->findMatchedDivisionsWithDimension($sampleType, $storageContainer);
        $matchedDimensionless = $repo->findMatchedDimensionlessDivisions($sampleType, $storageContainer);

        if (count($matchedWithDimensions) !== 0) {

            $emptyCells = $this->getEmptyCells($matchedWithDimensions[0]);

            foreach ($emptyCells as $rowKey => $emptyRow) {

                foreach ($emptyRow as $columnKey => $emptyColumn) {

                    return array(
                        'division' => $matchedWithDimensions[0],
                        'divisionRow' => $rowKey,
                        'divisionColumn' => $columnKey,
                    );

                }
            }


        }

        if (count($matchedDimensionless) !== 0) {
            return $matchedDimensionless[0];
        }

        // no matches
        return array();
    }

    private function getEmptyCells(Division $division)
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
}

<?php

namespace AppBundle\Service;

use AppBundle\Entity\SampleType;

class SampleImporter
{
    protected $sampleTypeColumnMap = array(
        'DNA' => array(
            'name' => 'Name',
            'description' => 'Description',
            'status' => 'Status',
            'storageContainer' => 'Storage Container',
            'storageBuffer' => 'Storage Buffer',
            'linkedSamples' => 'Linked Samples',

            'vectorName' => 'Vector Name',
            'concentration' => 'Concentration',
            'concentrationUnits' => 'Concentration Units',
            'dnaSequence' => 'DNA Sequence',
            'aminoAcidSequence' => 'Amino Acid Sequence',
            'totalAminoAcids' => 'Total Amino Acids',
            'molecularWeight' => 'Molecular Weight',
            'extinctionCoefficient' => 'Extinction Coefficient',
            'purificationTags' => 'Purification Tags',
            'division' => 'Division',
            'divisionRow' => 'Division Row',
            'divisionColumn' => 'Division Column',

        )
    );

    public function __construct()
    {
    }

    public function getTemplateContent(SampleType $sampleType)
    {
        return implode(',', $this->sampleTypeColumnMap[$sampleType->getName()]);
    }
}

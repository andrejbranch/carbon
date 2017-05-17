<?php

namespace AppBundle\Service;

use AppBundle\Entity\Storage\SampleType;

class SampleImporter
{
    protected $sampleTypeColumnMap = array(
        'DNA' => array(
            'name' => 'Name',
            'description' => 'Description',
            'status' => 'Status',
            'storageContainer' => 'Storage Container',
            'storageBuffer' => 'Storage Buffer',
            'projects' => 'Projects',
            'linkedSamples' => 'Linked Samples',

            // specific to DNA
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
        ),
        'Protein' => array(
            'name' => 'Name',
            'description' => 'Description',
            'status' => 'Status',
            'storageContainer' => 'Storage Container',
            'storageBuffer' => 'Storage Buffer',
            'projects' => 'Projects',
            'linkedSamples' => 'Linked Samples',
            'division' => 'Division',
            'divisionRow' => 'Division Row',
            'divisionColumn' => 'Division Column',
        ),
        'Sera' => array(
            'name' => 'Name',
            'description' => 'Description',
            'status' => 'Status',
            'storageContainer' => 'Storage Container',
            'storageBuffer' => 'Storage Buffer',
            'projects' => 'Projects',
            'linkedSamples' => 'Linked Samples',
            'division' => 'Division',
            'divisionRow' => 'Division Row',
            'divisionColumn' => 'Division Column',
            'species' => 'Species',
        ),
        'Bacterial Cells' => array(
            'name' => 'Name',
            'description' => 'Description',
            'status' => 'Status',
            'storageContainer' => 'Storage Container',
            'storageBuffer' => 'Storage Buffer',
            'projects' => 'Projects',
            'linkedSamples' => 'Linked Samples',
            'division' => 'Division',
            'divisionRow' => 'Division Row',
            'divisionColumn' => 'Division Column',
            'cellLine' => 'Cell Line',
        ),
        'Mammalian Cells' => array(
            'name' => 'Name',
            'description' => 'Description',
            'status' => 'Status',
            'storageContainer' => 'Storage Container',
            'storageBuffer' => 'Storage Buffer',
            'projects' => 'Projects',
            'linkedSamples' => 'Linked Samples',
            'division' => 'Division',
            'divisionRow' => 'Division Row',
            'divisionColumn' => 'Division Column',
            'cellLine' => 'Cell Line',
        ),
        'Yeast Cells' => array(
            'name' => 'Name',
            'description' => 'Description',
            'status' => 'Status',
            'storageContainer' => 'Storage Container',
            'storageBuffer' => 'Storage Buffer',
            'projects' => 'Projects',
            'linkedSamples' => 'Linked Samples',
            'division' => 'Division',
            'divisionRow' => 'Division Row',
            'divisionColumn' => 'Division Column',
            'cellLine' => 'Cell Line',
        ),
        'Chemical Compound' => array(
            'name' => 'Name',
            'description' => 'Description',
            'status' => 'Status',
            'storageContainer' => 'Storage Container',
            'storageBuffer' => 'Storage Buffer',
            'projects' => 'Projects',
            'linkedSamples' => 'Linked Samples',
            'division' => 'Division',
            'divisionRow' => 'Division Row',
            'divisionColumn' => 'Division Column',
            'mass' => 'Mass',
        ),
        'Solution' => array(
            'name' => 'Name',
            'description' => 'Description',
            'status' => 'Status',
            'storageContainer' => 'Storage Container',
            'storageBuffer' => 'Storage Buffer',
            'projects' => 'Projects',
            'linkedSamples' => 'Linked Samples',
            'division' => 'Division',
            'divisionRow' => 'Division Row',
            'divisionColumn' => 'Division Column',
            'mass' => 'Mass',
        ),
        'Other' => array(
            'name' => 'Name',
            'description' => 'Description',
            'status' => 'Status',
            'storageContainer' => 'Storage Container',
            'storageBuffer' => 'Storage Buffer',
            'projects' => 'Projects',
            'linkedSamples' => 'Linked Samples',
            'division' => 'Division',
            'divisionRow' => 'Division Row',
            'divisionColumn' => 'Division Column'
        ),
    );

    public function __construct()
    {
    }

    public function getTemplateContent(SampleType $sampleType)
    {
        return implode(',', $this->sampleTypeColumnMap[$sampleType->getName()]);
    }
}

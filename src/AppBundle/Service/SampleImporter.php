<?php

namespace AppBundle\Service;

use AppBundle\Entity\Storage\SampleType;
use Carbon\ApiBundle\Validator\Constraints as CarbonAssert;
use Ddeboer\DataImport\Filter\ValidatorFilter;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validator\RecursiveValidator;

class SampleImporter
{
    protected  $sampleTypeMapping = array(
        'DNA' => array(
            'Sample Type' => array(
                'prop' => 'sampleType',
                'bindTo' => 'sampleType.name',
                'frontendBindTo' => 'sampleType.name',
                'errorProp' => array('sampleType'),
            ),
            'Catalog' => array(
                'prop' => 'catalog',
                'bindTo' => 'catalog.name',
                'frontendBindTo' => 'catalog.name',
                'errorProp' => array('catalog'),
            ),
            'Description' => array(
                'prop' => 'description',
                'bindTo' => 'description',
                'frontendBindTo' => 'description',
                'errorProp' => array('description'),
            ),
            'Status' => array(
                'prop' => 'status',
                'bindTo' => 'status',
                'frontendBindTo' => 'status',
                'errorProp' => array('status'),
            ),
            'Lot' => array(
                'prop' => 'lot',
                'bindTo' => 'lot',
                'frontendBindTo' => 'lot',
                'errorProp' => array('lot'),
            ),
            'Tags' => array(
                'mtm' => true,
                'bindTo' => 'tagId',
                'prop' => 'sampleTags',
                'frontendBindTo' => 'tagString',
                'errorProp' => array('sampleTags'),
            ),
            'Storage Container' => array(
                'prop' => 'storageContainer',
                'bindTo' => 'storageContainer.name',
                'frontendBindTo' => 'storageContainer.name',
                'errorProp' => array('storageContainer'),
            ),
            'Storage Buffer' => array(
                'prop' => 'storageBuffer',
                'bindTo' => 'storageBuffer',
                'frontendBindTo' => 'storageBuffer',
                'errorProp' => array('storageBuffer'),
            ),
            'Projects' => array(
                'mtm' => true,
                'prop' => 'projectSamples',
                'bindTo' => 'projectId',
                'frontendBindTo' => 'projectString',
                'errorProp' => array('projectSamples'),
            ),
            'Vector Name' => array(
                'prop' => 'vectorName',
                'bindTo' => 'vectorName',
                'frontendBindTo' => 'vectorName',
                'errorProp' => array('vectorName'),
            ),
            'Concentration' => array(
                'prop' => 'concentration',
                'bindTo' => 'concentration',
                'frontendBindTo' => 'concentration',
                'errorProp' => array('concentration'),
            ),
            'Concentration Units' => array(
                'prop' => 'concentrationUnits',
                'bindTo' => 'concentrationUnits',
                'frontendBindTo' => 'concentrationUnits',
                'errorProp' => array('concentrationUnits'),
            ),
            'Volume' => array(
                'prop' => 'volume',
                'bindTo' => 'volume',
                'frontendBindTo' => 'volume',
                'errorProp' => array('volume'),
            ),
            'Volume Units' => array(
                'prop' => 'volumeUnits',
                'bindTo' => 'volumeUnits',
                'frontendBindTo' => 'volumeUnits',
                'errorProp' => array('volumeUnits'),
            ),
            'DNA Sequence' => array(
                'prop' => 'dnaSequence',
                'bindTo' => 'dnaSequence',
                'frontendBindTo' => 'dnaSequence',
                'errorProp' => array('dnaSequence'),
            ),
            'Amino Acid Sequence' => array(
                'prop' => 'aminoAcidSequence',
                'bindTo' => 'aminoAcidSequence',
                'frontendBindTo' => 'aminoAcidSequence',
                'errorProp' => array('aminoAcidSequence'),
            ),
            'Total Amino Acids' => array(
                'prop' => 'aminoAcidCount',
                'bindTo' => 'aminoAcidCount',
                'frontendBindTo' => 'aminoAcidCount',
                'errorProp' => array('aminoAcidCount'),
            ),
            'Molecular Weight' => array(
                'prop' => 'molecularWeight',
                'bindTo' => 'molecularWeight',
                'frontendBindTo' => 'molecularWeight',
                'errorProp' => array('molecularWeight'),
            ),
            'Extinction Coefficient' => array(
                'prop' => 'extinctionCoefficient',
                'bindTo' => 'extinctionCoefficient',
                'frontendBindTo' => 'extinctionCoefficient',
                'errorProp' => array('extinctionCoefficient'),
            ),
            'Purification Tags' => array(
                'prop' => 'purificationTags',
                'bindTo' => 'purificationTags',
                'frontendBindTo' => 'purificationTags',
                'errorProp' => array('purificationTags'),
            ),
            'Division' => array(
                'prop' => 'division',
                'bindTo' => 'division.id',
                'frontendBindTo' => 'division.id',
                'errorProp' => array('division'),
            ),
            'Division Row' => array(
                'prop' => 'divisionRow',
                'bindTo' => 'divisionRow',
                'frontendBindTo' => 'divisionRow',
                'errorProp' => array('divisionRow', 'storageLocation'),
            ),
            'Division Column' => array(
                'prop' => 'divisionColumn',
                'bindTo' => 'divisionColumn',
                'frontendBindTo' => 'divisionColumn',
                'errorProp' => array('divisionColumn', 'storageLocation'),
            ),
        ),
        'Protein' => array(
            'Sample Type' => array(
                'prop' => 'sampleType',
                'bindTo' => 'sampleType.name',
                'frontendBindTo' => 'sampleType.name',
                'errorProp' => array('sampleType'),
            ),
            'Catalog' => array(
                'prop' => 'catalog',
                'bindTo' => 'catalog.name',
                'frontendBindTo' => 'catalog.name',
                'errorProp' => array('catalog'),
            ),
            'Description' => array(
                'prop' => 'description',
                'bindTo' => 'description',
                'frontendBindTo' => 'description',
                'errorProp' => array('description'),
            ),
            'Status' => array(
                'prop' => 'status',
                'bindTo' => 'status',
                'frontendBindTo' => 'status',
                'errorProp' => array('status'),
            ),
            'Lot' => array(
                'prop' => 'lot',
                'bindTo' => 'lot',
                'frontendBindTo' => 'lot',
                'errorProp' => array('lot'),
            ),
            'Tags' => array(
                'mtm' => true,
                'bindTo' => 'tagId',
                'prop' => 'sampleTags',
                'frontendBindTo' => 'tagString',
                'errorProp' => array('sampleTags'),
            ),
            'Storage Container' => array(
                'prop' => 'storageContainer',
                'bindTo' => 'storageContainer.name',
                'frontendBindTo' => 'storageContainer.name',
                'errorProp' => array('storageContainer'),
            ),
            'Storage Buffer' => array(
                'prop' => 'storageBuffer',
                'bindTo' => 'storageBuffer',
                'frontendBindTo' => 'storageBuffer',
                'errorProp' => array('storageBuffer'),
            ),
            'Projects' => array(
                'mtm' => true,
                'prop' => 'projectSamples',
                'bindTo' => 'projectId',
                'frontendBindTo' => 'projectString',
                'errorProp' => array('projectSamples'),
            ),
            'Concentration' => array(
                'prop' => 'concentration',
                'bindTo' => 'concentration',
                'frontendBindTo' => 'concentration',
                'errorProp' => array('concentration'),
            ),
            'Concentration Units' => array(
                'prop' => 'concentrationUnits',
                'bindTo' => 'concentrationUnits',
                'frontendBindTo' => 'concentrationUnits',
                'errorProp' => array('concentrationUnits'),
            ),
            'Volume' => array(
                'prop' => 'volume',
                'bindTo' => 'volume',
                'frontendBindTo' => 'volume',
                'errorProp' => array('volume'),
            ),
            'Volume Units' => array(
                'prop' => 'volumeUnits',
                'bindTo' => 'volumeUnits',
                'frontendBindTo' => 'volumeUnits',
                'errorProp' => array('volumeUnits'),
            ),
            'Division' => array(
                'prop' => 'division',
                'bindTo' => 'division.stringLabel',
                'frontendBindTo' => 'division.stringLabel',
                'errorProp' => array('division'),
            ),
            'Division Row' => array(
                'prop' => 'divisionRow',
                'bindTo' => 'divisionRow',
                'frontendBindTo' => 'divisionRow',
                'errorProp' => array('divisionRow', 'storageLocation'),
            ),
            'Division Column' => array(
                'prop' => 'divisionColumn',
                'bindTo' => 'divisionColumn',
                'frontendBindTo' => 'divisionColumn',
                'errorProp' => array('divisionColumn', 'storageLocation'),
            ),
        ),
        'Sera' => array(
            'Sample Type' => array(
                'prop' => 'sampleType',
                'bindTo' => 'sampleType.name',
                'frontendBindTo' => 'sampleType.name',
                'errorProp' => array('sampleType'),
            ),
            'Catalog' => array(
                'prop' => 'catalog',
                'bindTo' => 'catalog',
                'frontendBindTo' => 'catalog',
                'errorProp' => array('catalog'),
            ),
            'Description' => array(
                'prop' => 'description',
                'bindTo' => 'description',
                'frontendBindTo' => 'description',
                'errorProp' => array('description'),
            ),
            'Status' => array(
                'prop' => 'status',
                'bindTo' => 'status',
                'frontendBindTo' => 'status',
                'errorProp' => array('status'),
            ),
            'Lot' => array(
                'prop' => 'lot',
                'bindTo' => 'lot',
                'frontendBindTo' => 'lot',
                'errorProp' => array('lot'),
            ),
            'Tags' => array(
                'mtm' => true,
                'bindTo' => 'tagId',
                'prop' => 'sampleTags',
                'frontendBindTo' => 'tagString',
                'errorProp' => array('sampleTags'),
            ),
            'Storage Container' => array(
                'prop' => 'storageContainer',
                'bindTo' => 'storageContainer.name',
                'frontendBindTo' => 'storageContainer.name',
                'errorProp' => array('storageContainer'),
            ),
            'Storage Buffer' => array(
                'prop' => 'storageBuffer',
                'bindTo' => 'storageBuffer',
                'frontendBindTo' => 'storageBuffer',
                'errorProp' => array('storageBuffer'),
            ),
            'Projects' => array(
                'mtm' => true,
                'prop' => 'projectSamples',
                'bindTo' => 'projectId',
                'frontendBindTo' => 'projectString',
                'errorProp' => array('projectSamples'),
            ),
            'Concentration' => array(
                'prop' => 'concentration',
                'bindTo' => 'concentration',
                'frontendBindTo' => 'concentration',
                'errorProp' => array('concentration'),
            ),
            'Concentration Units' => array(
                'prop' => 'concentrationUnits',
                'bindTo' => 'concentrationUnits',
                'frontendBindTo' => 'concentrationUnits',
                'errorProp' => array('concentrationUnits'),
            ),
            'Volume' => array(
                'prop' => 'volume',
                'bindTo' => 'volume',
                'frontendBindTo' => 'volume',
                'errorProp' => array('volume'),
            ),
            'Volume Units' => array(
                'prop' => 'volumeUnits',
                'bindTo' => 'volumeUnits',
                'frontendBindTo' => 'volumeUnits',
                'errorProp' => array('volumeUnits'),
            ),
            'Division' => array(
                'prop' => 'division',
                'bindTo' => 'division.stringLabel',
                'frontendBindTo' => 'division.stringLabel',
                'errorProp' => array('division'),
            ),
            'Division Row' => array(
                'prop' => 'divisionRow',
                'bindTo' => 'divisionRow',
                'frontendBindTo' => 'divisionRow',
                'errorProp' => array('divisionRow', 'storageLocation'),
            ),
            'Division Column' => array(
                'prop' => 'divisionColumn',
                'bindTo' => 'divisionColumn',
                'frontendBindTo' => 'divisionColumn',
                'errorProp' => array('divisionColumn', 'storageLocation'),
            ),
            'Species' => array(
                'prop' => 'species',
                'bindTo' => 'species',
                'frontendBindTo' => 'species',
                'errorProp' => array('species'),
            )
        ),
        'Bacterial Cells' => array(
            'Sample Type' => array(
                'prop' => 'sampleType',
                'bindTo' => 'sampleType.name',
                'frontendBindTo' => 'sampleType.name',
                'errorProp' => array('sampleType'),
            ),
            'Catalog' => array(
                'prop' => 'catalog',
                'bindTo' => 'catalog',
                'frontendBindTo' => 'catalog',
                'errorProp' => array('catalog'),
            ),
            'Description' => array(
                'prop' => 'description',
                'bindTo' => 'description',
                'frontendBindTo' => 'description',
                'errorProp' => array('description'),
            ),
            'Status' => array(
                'prop' => 'status',
                'bindTo' => 'status',
                'frontendBindTo' => 'status',
                'errorProp' => array('status'),
            ),
            'Lot' => array(
                'prop' => 'lot',
                'bindTo' => 'lot',
                'frontendBindTo' => 'lot',
                'errorProp' => array('lot'),
            ),
            'Tags' => array(
                'mtm' => true,
                'bindTo' => 'tagId',
                'prop' => 'sampleTags',
                'frontendBindTo' => 'tagString',
                'errorProp' => array('sampleTags'),
            ),
            'Storage Container' => array(
                'prop' => 'storageContainer',
                'bindTo' => 'storageContainer.name',
                'frontendBindTo' => 'storageContainer.name',
                'errorProp' => array('storageContainer'),
            ),
            'Storage Buffer' => array(
                'prop' => 'storageBuffer',
                'bindTo' => 'storageBuffer',
                'frontendBindTo' => 'storageBuffer',
                'errorProp' => array('storageBuffer'),
            ),
            'Projects' => array(
                'mtm' => true,
                'prop' => 'projectSamples',
                'bindTo' => 'projectId',
                'frontendBindTo' => 'projectString',
                'errorProp' => array('projectSamples'),
            ),
            'Concentration' => array(
                'prop' => 'concentration',
                'bindTo' => 'concentration',
                'frontendBindTo' => 'concentration',
                'errorProp' => array('concentration'),
            ),
            'Concentration Units' => array(
                'prop' => 'concentrationUnits',
                'bindTo' => 'concentrationUnits',
                'frontendBindTo' => 'concentrationUnits',
                'errorProp' => array('concentrationUnits'),
            ),
            'Volume' => array(
                'prop' => 'volume',
                'bindTo' => 'volume',
                'frontendBindTo' => 'volume',
                'errorProp' => array('volume'),
            ),
            'Volume Units' => array(
                'prop' => 'volumeUnits',
                'bindTo' => 'volumeUnits',
                'frontendBindTo' => 'volumeUnits',
                'errorProp' => array('volumeUnits'),
            ),
            'Division' => array(
                'prop' => 'division',
                'bindTo' => 'division.stringLabel',
                'frontendBindTo' => 'division.stringLabel',
                'errorProp' => array('division'),
            ),
            'Division Row' => array(
                'prop' => 'divisionRow',
                'bindTo' => 'divisionRow',
                'frontendBindTo' => 'divisionRow',
                'errorProp' => array('divisionRow', 'storageLocation'),
            ),
            'Division Column' => array(
                'prop' => 'divisionColumn',
                'bindTo' => 'divisionColumn',
                'frontendBindTo' => 'divisionColumn',
                'errorProp' => array('divisionColumn', 'storageLocation'),
            ),
            'Cell Line' => array(
                'prop' => 'cellLine',
                'bindTo' => 'cellLine',
                'frontendBindTo' => 'cellLine',
                'errorProp' => array('cellLine'),
            )
        ),
        'Mammalian Cells' => array(
            'Sample Type' => array(
                'prop' => 'sampleType',
                'bindTo' => 'sampleType.name',
                'frontendBindTo' => 'sampleType.name',
                'errorProp' => array('sampleType'),
            ),
            'Catalog' => array(
                'prop' => 'catalog',
                'bindTo' => 'catalog',
                'frontendBindTo' => 'catalog',
                'errorProp' => array('catalog'),
            ),
            'Description' => array(
                'prop' => 'description',
                'bindTo' => 'description',
                'frontendBindTo' => 'description',
                'errorProp' => array('description'),
            ),
            'Status' => array(
                'prop' => 'status',
                'bindTo' => 'status',
                'frontendBindTo' => 'status',
                'errorProp' => array('status'),
            ),
            'Lot' => array(
                'prop' => 'lot',
                'bindTo' => 'lot',
                'frontendBindTo' => 'lot',
                'errorProp' => array('lot'),
            ),
            'Tags' => array(
                'mtm' => true,
                'bindTo' => 'tagId',
                'prop' => 'sampleTags',
                'frontendBindTo' => 'tagString',
                'errorProp' => array('sampleTags'),
            ),
            'Storage Container' => array(
                'prop' => 'storageContainer',
                'bindTo' => 'storageContainer.name',
                'frontendBindTo' => 'storageContainer.name',
                'errorProp' => array('storageContainer'),
            ),
            'Storage Buffer' => array(
                'prop' => 'storageBuffer',
                'bindTo' => 'storageBuffer',
                'frontendBindTo' => 'storageBuffer',
                'errorProp' => array('storageBuffer'),
            ),
            'Projects' => array(
                'mtm' => true,
                'prop' => 'projectSamples',
                'bindTo' => 'projectId',
                'frontendBindTo' => 'projectString',
                'errorProp' => array('projectSamples'),
            ),
            'Concentration' => array(
                'prop' => 'concentration',
                'bindTo' => 'concentration',
                'frontendBindTo' => 'concentration',
                'errorProp' => array('concentration'),
            ),
            'Concentration Units' => array(
                'prop' => 'concentrationUnits',
                'bindTo' => 'concentrationUnits',
                'frontendBindTo' => 'concentrationUnits',
                'errorProp' => array('concentrationUnits'),
            ),
            'Volume' => array(
                'prop' => 'volume',
                'bindTo' => 'volume',
                'frontendBindTo' => 'volume',
                'errorProp' => array('volume'),
            ),
            'Volume Units' => array(
                'prop' => 'volumeUnits',
                'bindTo' => 'volumeUnits',
                'frontendBindTo' => 'volumeUnits',
                'errorProp' => array('volumeUnits'),
            ),
            'Division' => array(
                'prop' => 'division',
                'bindTo' => 'division.stringLabel',
                'frontendBindTo' => 'division.stringLabel',
                'errorProp' => array('division'),
            ),
            'Division Row' => array(
                'prop' => 'divisionRow',
                'bindTo' => 'divisionRow',
                'frontendBindTo' => 'divisionRow',
                'errorProp' => array('divisionRow', 'storageLocation'),
            ),
            'Division Column' => array(
                'prop' => 'divisionColumn',
                'bindTo' => 'divisionColumn',
                'frontendBindTo' => 'divisionColumn',
                'errorProp' => array('divisionColumn', 'storageLocation'),
            ),
            'Cell Line' => array(
                'prop' => 'cellLine',
                'bindTo' => 'cellLine',
                'frontendBindTo' => 'cellLine',
                'errorProp' => array('cellLine'),
            )
        ),
        'Yeast Cells' => array(
            'Sample Type' => array(
                'prop' => 'sampleType',
                'bindTo' => 'sampleType.name',
                'frontendBindTo' => 'sampleType.name',
                'errorProp' => array('sampleType'),
            ),
            'Catalog' => array(
                'prop' => 'catalog',
                'bindTo' => 'catalog',
                'frontendBindTo' => 'catalog',
                'errorProp' => array('catalog'),
            ),
            'Description' => array(
                'prop' => 'description',
                'bindTo' => 'description',
                'frontendBindTo' => 'description',
                'errorProp' => array('description'),
            ),
            'Status' => array(
                'prop' => 'status',
                'bindTo' => 'status',
                'frontendBindTo' => 'status',
                'errorProp' => array('status'),
            ),
            'Lot' => array(
                'prop' => 'lot',
                'bindTo' => 'lot',
                'frontendBindTo' => 'lot',
                'errorProp' => array('lot'),
            ),
            'Tags' => array(
                'mtm' => true,
                'bindTo' => 'tagId',
                'prop' => 'sampleTags',
                'frontendBindTo' => 'tagString',
                'errorProp' => array('sampleTags'),
            ),
            'Storage Container' => array(
                'prop' => 'storageContainer',
                'bindTo' => 'storageContainer.name',
                'frontendBindTo' => 'storageContainer.name',
                'errorProp' => array('storageContainer'),
            ),
            'Storage Buffer' => array(
                'prop' => 'storageBuffer',
                'bindTo' => 'storageBuffer',
                'frontendBindTo' => 'storageBuffer',
                'errorProp' => array('storageBuffer'),
            ),
            'Projects' => array(
                'mtm' => true,
                'prop' => 'projectSamples',
                'bindTo' => 'projectId',
                'frontendBindTo' => 'projectString',
                'errorProp' => array('projectSamples'),
            ),
            'Concentration' => array(
                'prop' => 'concentration',
                'bindTo' => 'concentration',
                'frontendBindTo' => 'concentration',
                'errorProp' => array('concentration'),
            ),
            'Concentration Units' => array(
                'prop' => 'concentrationUnits',
                'bindTo' => 'concentrationUnits',
                'frontendBindTo' => 'concentrationUnits',
                'errorProp' => array('concentrationUnits'),
            ),
            'Volume' => array(
                'prop' => 'volume',
                'bindTo' => 'volume',
                'frontendBindTo' => 'volume',
                'errorProp' => array('volume'),
            ),
            'Volume Units' => array(
                'prop' => 'volumeUnits',
                'bindTo' => 'volumeUnits',
                'frontendBindTo' => 'volumeUnits',
                'errorProp' => array('volumeUnits'),
            ),
            'Division' => array(
                'prop' => 'division',
                'bindTo' => 'division.stringLabel',
                'frontendBindTo' => 'division.stringLabel',
                'errorProp' => array('division'),
            ),
            'Division Row' => array(
                'prop' => 'divisionRow',
                'bindTo' => 'divisionRow',
                'frontendBindTo' => 'divisionRow',
                'errorProp' => array('divisionRow', 'storageLocation'),
            ),
            'Division Column' => array(
                'prop' => 'divisionColumn',
                'bindTo' => 'divisionColumn',
                'frontendBindTo' => 'divisionColumn',
                'errorProp' => array('divisionColumn', 'storageLocation'),
            ),
            'Cell Line' => array(
                'prop' => 'cellLine',
                'bindTo' => 'cellLine',
                'frontendBindTo' => 'cellLine',
                'errorProp' => array('cellLine'),
            )
        ),
        'Chemical Compound' => array(
            'Sample Type' => array(
                'prop' => 'sampleType',
                'bindTo' => 'sampleType.name',
                'frontendBindTo' => 'sampleType.name',
                'errorProp' => array('sampleType'),
            ),
            'Catalog' => array(
                'prop' => 'catalog',
                'bindTo' => 'catalog',
                'frontendBindTo' => 'catalog',
                'errorProp' => array('catalog'),
            ),
            'Description' => array(
                'prop' => 'description',
                'bindTo' => 'description',
                'frontendBindTo' => 'description',
                'errorProp' => array('description'),
            ),
            'Status' => array(
                'prop' => 'status',
                'bindTo' => 'status',
                'frontendBindTo' => 'status',
                'errorProp' => array('status'),
            ),
            'Lot' => array(
                'prop' => 'lot',
                'bindTo' => 'lot',
                'frontendBindTo' => 'lot',
                'errorProp' => array('lot'),
            ),
            'Tags' => array(
                'mtm' => true,
                'bindTo' => 'tagId',
                'prop' => 'sampleTags',
                'frontendBindTo' => 'tagString',
                'errorProp' => array('sampleTags'),
            ),
            'Storage Container' => array(
                'prop' => 'storageContainer',
                'bindTo' => 'storageContainer.name',
                'frontendBindTo' => 'storageContainer.name',
                'errorProp' => array('storageContainer'),
            ),
            'Storage Buffer' => array(
                'prop' => 'storageBuffer',
                'bindTo' => 'storageBuffer',
                'frontendBindTo' => 'storageBuffer',
                'errorProp' => array('storageBuffer'),
            ),
            'Projects' => array(
                'mtm' => true,
                'prop' => 'projectSamples',
                'bindTo' => 'projectId',
                'frontendBindTo' => 'projectString',
                'errorProp' => array('projectSamples'),
            ),
            'Concentration' => array(
                'prop' => 'concentration',
                'bindTo' => 'concentration',
                'frontendBindTo' => 'concentration',
                'errorProp' => array('concentration'),
            ),
            'Concentration Units' => array(
                'prop' => 'concentrationUnits',
                'bindTo' => 'concentrationUnits',
                'frontendBindTo' => 'concentrationUnits',
                'errorProp' => array('concentrationUnits'),
            ),
            'Volume' => array(
                'prop' => 'volume',
                'bindTo' => 'volume',
                'frontendBindTo' => 'volume',
                'errorProp' => array('volume'),
            ),
            'Volume Units' => array(
                'prop' => 'volumeUnits',
                'bindTo' => 'volumeUnits',
                'frontendBindTo' => 'volumeUnits',
                'errorProp' => array('volumeUnits'),
            ),
            'Division' => array(
                'prop' => 'division',
                'bindTo' => 'division.stringLabel',
                'frontendBindTo' => 'division.stringLabel',
                'errorProp' => array('division'),
            ),
            'Division Row' => array(
                'prop' => 'divisionRow',
                'bindTo' => 'divisionRow',
                'frontendBindTo' => 'divisionRow',
                'errorProp' => array('divisionRow', 'storageLocation'),
            ),
            'Division Column' => array(
                'prop' => 'divisionColumn',
                'bindTo' => 'divisionColumn',
                'frontendBindTo' => 'divisionColumn',
                'errorProp' => array('divisionColumn', 'storageLocation'),
            ),
            'Mass (g)' => array(
                'prop' => 'mass',
                'bindTo' => 'mass',
                'frontendBindTo' => 'mass',
                'errorProp' => array('mass'),
            )
        ),
        'Solution' => array(
            'Sample Type' => array(
                'prop' => 'sampleType',
                'bindTo' => 'sampleType.name',
                'frontendBindTo' => 'sampleType.name',
                'errorProp' => array('sampleType'),
            ),
            'Catalog' => array(
                'prop' => 'catalog',
                'bindTo' => 'catalog',
                'frontendBindTo' => 'catalog',
                'errorProp' => array('catalog'),
            ),
            'Description' => array(
                'prop' => 'description',
                'bindTo' => 'description',
                'frontendBindTo' => 'description',
                'errorProp' => array('description'),
            ),
            'Status' => array(
                'prop' => 'status',
                'bindTo' => 'status',
                'frontendBindTo' => 'status',
                'errorProp' => array('status'),
            ),
            'Lot' => array(
                'prop' => 'lot',
                'bindTo' => 'lot',
                'frontendBindTo' => 'lot',
                'errorProp' => array('lot'),
            ),
            'Tags' => array(
                'mtm' => true,
                'bindTo' => 'tagId',
                'prop' => 'sampleTags',
                'frontendBindTo' => 'tagString',
                'errorProp' => array('sampleTags'),
            ),
            'Concentration' => array(
                'prop' => 'concentration',
                'bindTo' => 'concentration',
                'frontendBindTo' => 'concentration',
                'errorProp' => array('concentration'),
            ),
            'Concentration Units' => array(
                'prop' => 'concentrationUnits',
                'bindTo' => 'concentrationUnits',
                'frontendBindTo' => 'concentrationUnits',
                'errorProp' => array('concentrationUnits'),
            ),
            'Volume' => array(
                'prop' => 'volume',
                'bindTo' => 'volume',
                'frontendBindTo' => 'volume',
                'errorProp' => array('volume'),
            ),
            'Volume Units' => array(
                'prop' => 'volumeUnits',
                'bindTo' => 'volumeUnits',
                'frontendBindTo' => 'volumeUnits',
                'errorProp' => array('volumeUnits'),
            ),
            'Storage Container' => array(
                'prop' => 'storageContainer',
                'bindTo' => 'storageContainer.name',
                'frontendBindTo' => 'storageContainer.name',
                'errorProp' => array('storageContainer'),
            ),
            'Storage Buffer' => array(
                'prop' => 'storageBuffer',
                'bindTo' => 'storageBuffer',
                'frontendBindTo' => 'storageBuffer',
                'errorProp' => array('storageBuffer'),
            ),
            'Projects' => array(
                'mtm' => true,
                'prop' => 'projectSamples',
                'bindTo' => 'projectId',
                'frontendBindTo' => 'projectString',
                'errorProp' => array('projectSamples'),
            ),
            'Division' => array(
                'prop' => 'division',
                'bindTo' => 'division.stringLabel',
                'frontendBindTo' => 'division.stringLabel',
                'errorProp' => array('division'),
            ),
            'Division Row' => array(
                'prop' => 'divisionRow',
                'bindTo' => 'divisionRow',
                'frontendBindTo' => 'divisionRow',
                'errorProp' => array('divisionRow', 'storageLocation'),
            ),
            'Division Column' => array(
                'prop' => 'divisionColumn',
                'bindTo' => 'divisionColumn',
                'frontendBindTo' => 'divisionColumn',
                'errorProp' => array('divisionColumn', 'storageLocation'),
            ),
        ),
        'Other' => array(
            'Sample Type' => array(
                'prop' => 'sampleType',
                'bindTo' => 'sampleType.name',
                'frontendBindTo' => 'sampleType.name',
                'errorProp' => array('sampleType'),
            ),
            'Catalog' => array(
                'prop' => 'catalog',
                'bindTo' => 'catalog',
                'frontendBindTo' => 'catalog',
                'errorProp' => array('catalog'),
            ),
            'Description' => array(
                'prop' => 'description',
                'bindTo' => 'description',
                'frontendBindTo' => 'description',
                'errorProp' => array('description'),
            ),
            'Status' => array(
                'prop' => 'status',
                'bindTo' => 'status',
                'frontendBindTo' => 'status',
                'errorProp' => array('status'),
            ),
            'Lot' => array(
                'prop' => 'lot',
                'bindTo' => 'lot',
                'errorProp' => array('lot'),
            ),
            'Tags' => array(
                'mtm' => true,
                'bindTo' => 'tagId',
                'prop' => 'sampleTags',
                'frontendBindTo' => 'tagString',
                'errorProp' => array('sampleTags'),
            ),
            'Storage Container' => array(
                'prop' => 'storageContainer',
                'bindTo' => 'storageContainer.name',
                'frontendBindTo' => 'storageContainer.name',
                'errorProp' => array('storageContainer'),
            ),
            'Storage Buffer' => array(
                'prop' => 'storageBuffer',
                'bindTo' => 'storageBuffer',
                'frontendBindTo' => 'storageBuffer',
                'errorProp' => array('storageBuffer'),
            ),
            'Concentration' => array(
                'prop' => 'concentration',
                'bindTo' => 'concentration',
                'frontendBindTo' => 'concentration',
                'errorProp' => array('concentration'),
            ),
            'Concentration Units' => array(
                'prop' => 'concentrationUnits',
                'bindTo' => 'concentrationUnits',
                'frontendBindTo' => 'concentrationUnits',
                'errorProp' => array('concentrationUnits'),
            ),
            'Volume' => array(
                'prop' => 'volume',
                'bindTo' => 'volume',
                'frontendBindTo' => 'volume',
                'errorProp' => array('volume'),
            ),
            'Volume Units' => array(
                'prop' => 'volumeUnits',
                'bindTo' => 'volumeUnits',
                'frontendBindTo' => 'volumeUnits',
                'errorProp' => array('volumeUnits'),
            ),
            'Projects' => array(
                'mtm' => true,
                'prop' => 'projectSamples',
                'bindTo' => 'projectId',
                'frontendBindTo' => 'projectString',
                'errorProp' => array('projectSamples'),
            ),
            'Division' => array(
                'prop' => 'division',
                'bindTo' => 'division.stringLabel',
                'frontendBindTo' => 'division.stringLabel',
                'errorProp' => array('division'),
            ),
            'Division Row' => array(
                'prop' => 'divisionRow',
                'bindTo' => 'divisionRow',
                'frontendBindTo' => 'divisionRow',
                'errorProp' => array('divisionRow', 'storageLocation'),
            ),
            'Division Column' => array(
                'prop' => 'divisionColumn',
                'bindTo' => 'divisionColumn',
                'frontendBindTo' => 'divisionColumn',
                'errorProp' => array('divisionColumn', 'storageLocation'),
            ),
        ),
    );

    public function __construct(RecursiveValidator $validator)
    {
        $this->validator = $validator;
    }

    public function getTemplateContent(SampleType $sampleType)
    {
        return implode(array_keys($this->sampleTypeMapping[$sampleType->getName()]), ',');
    }

    public function getMapping(SampleType $sampleType)
    {
        return $this->sampleTypeMapping[$sampleType->getName()];
    }

    public function getFilter(SampleType $sampleType, $isUpdate = false)
    {
        $filter = new ValidatorFilter($this->validator);

        if ($isUpdate) {
            $filter->add('id', new Assert\NotBlank());
        }
        $filter->add('catalog', new Assert\NotBlank());
        // $filter->add('catalog', new CarbonAssert\StringToObject(array(
        //     'objectName' => 'catalog',
        //     'entity' => "AppBundle\\Entity\\Storage\\Catalog",
        //     'property' => 'name',
        // )));
        $filter->add('description', new Assert\NotBlank(array(
            'message' => 'description can not be blank',
        )));
        $filter->add('sampleType', new CarbonAssert\StringToObject(array(
            'objectName' => 'sampleType',
            'entity' => "AppBundle\\Entity\\Storage\\SampleType",
            'property' => 'name',
        )));
        $filter->add('status', new Assert\Choice(array(
            'choices' => array(
                'Available',
                'Depleted',
                'Destroyed',
                'Shipped'
            ),
            'message' => 'Invalid status {{ value }}'
        )));
        $filter->add('lot', new Assert\Optional());

        $filter->add('tags', new Assert\Optional());
        $filter->add('sampleTags', new Assert\Optional());

        $filter->add('sampleTags', new Assert\Regex(array(
            'pattern' => '/^[\d,\d]*[\d]$/',
            'message' => 'Tags should be a comma separated list of tag id(s)',
        )));

        $filter->add('sampleTags', new CarbonAssert\StringToObject(array(
            'objectName' => 'tag',
            'entity' => "AppBundle\\Entity\\Storage\\Tag",
            'property' => 'id',
            'regex' => '/^[\d,\d]*[\d]$/',
        )));

        $filter->add('projects', new Assert\Optional());
        $filter->add('projectSamples', new Assert\Optional());

        $filter->add('projectSamples', new Assert\Regex(array(
            'pattern' => '/^[\d,\d]*[\d]$/',
            'message' => 'Projects should be a comma separated list of tag id(s)',
        )));

        $filter->add('projectSamples', new CarbonAssert\StringToObject(array(
            'objectName' => 'project',
            'entity' => "AppBundle\\Entity\\Project",
            'property' => 'id',
            'regex' => '/^[\d,\d]*[\d]$/',
        )));

        $filter->add('storageContainer', new Assert\NotBlank());
        $filter->add('storageContainer', new CarbonAssert\StringToObject(array(
            'objectName' => 'storage container',
            'entity' => "AppBundle\\Entity\\Storage\\StorageContainer",
            'property' => 'name',
        )));
        $filter->add('storageBuffer', new Assert\NotBlank());

        $filter->add('division', new Assert\Optional());
        $filter->add('divisionRow', new Assert\Optional());
        $filter->add('divisionColumn', new Assert\Optional());

        $filter->add('division', new CarbonAssert\StringToObject(array(
            'objectName' => 'division',
            'entity' => "AppBundle\\Entity\\Storage\\Division",
            'property' => 'id',
        )));

        $filter->add('divisionRow', new Assert\Regex(array(
            'pattern' => "/^[A-T]$/",
            'message' => 'The division row is invalid'
        )));

        $filter->add('divisionColumn', new Assert\Range(array('min' => 1, 'max' => 20)));

        $filter->add('concentration', new Assert\Optional());
        $filter->add('concentrationUnits', new Assert\Choice(array(
            'choices' => array(
                'mg/mL',
                'ng/uL',
                'Molar',
            )
        )));

        $filter->add('volume', new Assert\Optional());
        $filter->add('volumeUnits', new Assert\Choice(array(
            'choices' => array(
                'mL',
                'uL'
            )
        )));

        if ($sampleType->getName() == 'DNA') {

            $filter->add('vectorName', new Assert\NotBlank());
            $filter->add('dnaSequence', new Assert\NotBlank(array(
                'message' => 'dnaSequence can not be blank',
            )));
            $filter->add('aminoAcidSequence', new Assert\NotBlank());
            $filter->add('aminoAcidCount', new Assert\NotBlank());
            $filter->add('molecularWeight', new Assert\NotBlank());
            $filter->add('extinctionCoefficient', new Assert\NotBlank());
            $filter->add('purificationTags', new Assert\NotBlank());

        }

        if ($sampleType->getName() == 'Sera') {
            $filter->add('species', new Assert\NotBlank());
        }

        if (
            $sampleType->getName() == 'Bacterial Cells' ||
            $sampleType->getName() == 'Mammalian Cells' ||
            $sampleType->getName() == 'Yeast Cells'
        ) {
            $filter->add('cellLine', new Assert\NotBlank());
        }

        if ($sampleType->getName() == 'Chemical Compound') {
            $filter->add('mass', new Assert\Type(array('type' => 'float')));
        }

        return $filter;
    }
}

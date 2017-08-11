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
            'Name' => array(
                'prop' => 'name',
                'bindTo' => 'name',
                'errorProp' => array('name'),
            ),
            'Description' => array(
                'prop' => 'description',
                'bindTo' => 'description',
                'errorProp' => array('description'),
            ),
            'Sample Type' => array(
                'prop' => 'sampleType',
                'bindTo' => 'sampleType.name',
                'errorProp' => array('sampleType'),
            ),
            'Status' => array(
                'prop' => 'status',
                'bindTo' => 'status',
                'errorProp' => array('status'),
            ),
            'Storage Container' => array(
                'prop' => 'storageContainer',
                'bindTo' => 'storageContainer.name',
                'errorProp' => array('storageContainer'),
            ),
            'Storage Buffer' => array(
                'prop' => 'storageBuffer',
                'bindTo' => 'storageBuffer',
                'errorProp' => array('storageBuffer'),
            ),
            'Projects' => array(
                'prop' => 'projects',
                'bindTo' => 'projects',
                'errorProp' => array('projects'),
            ),
            'Linked Samples' => array(
                'prop' => 'linkedSamples',
                'bindTo' => 'linkedSamples',
                'errorProp' => array('linkedSamples'),
            ),
            'Vector Name' => array(
                'prop' => 'vectorName',
                'bindTo' => 'vectorName',
                'errorProp' => array('vectorName'),
            ),
            'Concentration' => array(
                'prop' => 'concentration',
                'bindTo' => 'concentration',
                'errorProp' => array('concentration'),
            ),
            'Concentration Units' => array(
                'prop' => 'concentrationUnits',
                'bindTo' => 'concentrationUnits',
                'errorProp' => array('concentrationUnits'),
            ),
            'DNA Sequence' => array(
                'prop' => 'dnaSequence',
                'bindTo' => 'dnaSequence',
                'errorProp' => array('dnaSequence'),
            ),
            'Amino Acid Sequence' => array(
                'prop' => 'aminoAcidSequence',
                'bindTo' => 'aminoAcidSequence',
                'errorProp' => array('aminoAcidSequence'),
            ),
            'Total Amino Acids' => array(
                'prop' => 'aminoAcidCount',
                'bindTo' => 'aminoAcidCount',
                'errorProp' => array('aminoAcidCount'),
            ),
            'Molecular Weight' => array(
                'prop' => 'molecularWeight',
                'bindTo' => 'molecularWeight',
                'errorProp' => array('molecularWeight'),
            ),
            'Extinction Coefficient' => array(
                'prop' => 'extinctionCoefficient',
                'bindTo' => 'extinctionCoefficient',
                'errorProp' => array('extinctionCoefficient'),
            ),
            'Purification Tags' => array(
                'prop' => 'purificationTags',
                'bindTo' => 'purificationTags',
                'errorProp' => array('purificationTags'),
            ),
            'Division' => array(
                'prop' => 'division',
                'bindTo' => 'division.stringLabel',
                'errorProp' => array('division'),
            ),
            'Division Row' => array(
                'prop' => 'divisionRow',
                'bindTo' => 'divisionRow',
                'errorProp' => array('divisionRow', 'storageLocation'),
            ),
            'Division Column' => array(
                'prop' => 'divisionColumn',
                'bindTo' => 'divisionColumn',
                'errorProp' => array('divisionColumn', 'storageLocation'),
            ),
        ),
        'Protein' => array(
            'Name' => array(
                'prop' => 'name',
                'bindTo' => 'name',
                'errorProp' => array('name'),
            ),
            'Description' => array(
                'prop' => 'description',
                'bindTo' => 'description',
                'errorProp' => array('description'),
            ),
            'Status' => array(
                'prop' => 'status',
                'bindTo' => 'status',
                'errorProp' => array('status'),
            ),
            'Storage Container' => array(
                'prop' => 'storageContainer',
                'bindTo' => 'storageContainer.name',
                'errorProp' => array('storageContainer'),
            ),
            'Storage Buffer' => array(
                'prop' => 'storageBuffer',
                'bindTo' => 'storageBuffer',
                'errorProp' => array('storageBuffer'),
            ),
            'Projects' => array(
                'prop' => 'projects',
                'bindTo' => 'projects',
                'errorProp' => array('projects'),
            ),
            'Linked Samples' => array(
                'prop' => 'linkedSamples',
                'bindTo' => 'linkedSamples',
                'errorProp' => array('linkedSamples'),
            ),
            'Division' => array(
                'prop' => 'division',
                'bindTo' => 'division.stringLabel',
                'errorProp' => array('division'),
            ),
            'Division Row' => array(
                'prop' => 'divisionRow',
                'bindTo' => 'divisionRow',
                'errorProp' => array('divisionRow', 'storageLocation'),
            ),
            'Division Column' => array(
                'prop' => 'divisionColumn',
                'bindTo' => 'divisionColumn',
                'errorProp' => array('divisionColumn', 'storageLocation'),
            ),
            'Sample Type' => array(
                'prop' => 'sampleType',
                'bindTo' => 'sampleType.name',
                'errorProp' => array('sampleType'),
            )
        ),
        'Sera' => array(
            'Name' => array(
                'prop' => 'name',
                'bindTo' => 'name',
                'errorProp' => array('name'),
            ),
            'Description' => array(
                'prop' => 'description',
                'bindTo' => 'description',
                'errorProp' => array('description'),
            ),
            'Status' => array(
                'prop' => 'status',
                'bindTo' => 'status',
                'errorProp' => array('status'),
            ),
            'Storage Container' => array(
                'prop' => 'storageContainer',
                'bindTo' => 'storageContainer.name',
                'errorProp' => array('storageContainer'),
            ),
            'Storage Buffer' => array(
                'prop' => 'storageBuffer',
                'bindTo' => 'storageBuffer',
                'errorProp' => array('storageBuffer'),
            ),
            'Projects' => array(
                'prop' => 'projects',
                'bindTo' => 'projects',
                'errorProp' => array('projects'),
            ),
            'Linked Samples' => array(
                'prop' => 'linkedSamples',
                'bindTo' => 'linkedSamples',
                'errorProp' => array('linkedSamples'),
            ),
            'Division' => array(
                'prop' => 'division',
                'bindTo' => 'division.stringLabel',
                'errorProp' => array('division'),
            ),
            'Division Row' => array(
                'prop' => 'divisionRow',
                'bindTo' => 'divisionRow',
                'errorProp' => array('divisionRow', 'storageLocation'),
            ),
            'Division Column' => array(
                'prop' => 'divisionColumn',
                'bindTo' => 'divisionColumn',
                'errorProp' => array('divisionColumn', 'storageLocation'),
            ),
            'Sample Type' => array(
                'prop' => 'sampleType',
                'bindTo' => 'sampleType.name',
                'errorProp' => array('sampleType'),
            ),
            'Species' => array(
                'prop' => 'species',
                'bindTo' => 'species',
                'errorProp' => array('species'),
            )
        ),
        'Bacterial Cells' => array(
            'Name' => array(
                'prop' => 'name',
                'bindTo' => 'name',
                'errorProp' => array('name'),
            ),
            'Description' => array(
                'prop' => 'description',
                'bindTo' => 'description',
                'errorProp' => array('description'),
            ),
            'Status' => array(
                'prop' => 'status',
                'bindTo' => 'status',
                'errorProp' => array('status'),
            ),
            'Storage Container' => array(
                'prop' => 'storageContainer',
                'bindTo' => 'storageContainer.name',
                'errorProp' => array('storageContainer'),
            ),
            'Storage Buffer' => array(
                'prop' => 'storageBuffer',
                'bindTo' => 'storageBuffer',
                'errorProp' => array('storageBuffer'),
            ),
            'Projects' => array(
                'prop' => 'projects',
                'bindTo' => 'projects',
                'errorProp' => array('projects'),
            ),
            'Linked Samples' => array(
                'prop' => 'linkedSamples',
                'bindTo' => 'linkedSamples',
                'errorProp' => array('linkedSamples'),
            ),
            'Division' => array(
                'prop' => 'division',
                'bindTo' => 'division.stringLabel',
                'errorProp' => array('division'),
            ),
            'Division Row' => array(
                'prop' => 'divisionRow',
                'bindTo' => 'divisionRow',
                'errorProp' => array('divisionRow', 'storageLocation'),
            ),
            'Division Column' => array(
                'prop' => 'divisionColumn',
                'bindTo' => 'divisionColumn',
                'errorProp' => array('divisionColumn', 'storageLocation'),
            ),
            'Sample Type' => array(
                'prop' => 'sampleType',
                'bindTo' => 'sampleType.name',
                'errorProp' => array('sampleType'),
            ),
            'Cell Line' => array(
                'prop' => 'cellLine',
                'bindTo' => 'cellLine',
                'errorProp' => array('cellLine'),
            )
        ),
        'Mammalian Cells' => array(
            'Name' => array(
                'prop' => 'name',
                'bindTo' => 'name',
                'errorProp' => array('name'),
            ),
            'Description' => array(
                'prop' => 'description',
                'bindTo' => 'description',
                'errorProp' => array('description'),
            ),
            'Status' => array(
                'prop' => 'status',
                'bindTo' => 'status',
                'errorProp' => array('status'),
            ),
            'Storage Container' => array(
                'prop' => 'storageContainer',
                'bindTo' => 'storageContainer.name',
                'errorProp' => array('storageContainer'),
            ),
            'Storage Buffer' => array(
                'prop' => 'storageBuffer',
                'bindTo' => 'storageBuffer',
                'errorProp' => array('storageBuffer'),
            ),
            'Projects' => array(
                'prop' => 'projects',
                'bindTo' => 'projects',
                'errorProp' => array('projects'),
            ),
            'Linked Samples' => array(
                'prop' => 'linkedSamples',
                'bindTo' => 'linkedSamples',
                'errorProp' => array('linkedSamples'),
            ),
            'Division' => array(
                'prop' => 'division',
                'bindTo' => 'division.stringLabel',
                'errorProp' => array('division'),
            ),
            'Division Row' => array(
                'prop' => 'divisionRow',
                'bindTo' => 'divisionRow',
                'errorProp' => array('divisionRow', 'storageLocation'),
            ),
            'Division Column' => array(
                'prop' => 'divisionColumn',
                'bindTo' => 'divisionColumn',
                'errorProp' => array('divisionColumn', 'storageLocation'),
            ),
            'Sample Type' => array(
                'prop' => 'sampleType',
                'bindTo' => 'sampleType.name',
                'errorProp' => array('sampleType'),
            ),
            'Cell Line' => array(
                'prop' => 'cellLine',
                'bindTo' => 'cellLine',
                'errorProp' => array('cellLine'),
            )
        ),
        'Yeast Cells' => array(
            'Name' => array(
                'prop' => 'name',
                'bindTo' => 'name',
                'errorProp' => array('name'),
            ),
            'Description' => array(
                'prop' => 'description',
                'bindTo' => 'description',
                'errorProp' => array('description'),
            ),
            'Status' => array(
                'prop' => 'status',
                'bindTo' => 'status',
                'errorProp' => array('status'),
            ),
            'Storage Container' => array(
                'prop' => 'storageContainer',
                'bindTo' => 'storageContainer.name',
                'errorProp' => array('storageContainer'),
            ),
            'Storage Buffer' => array(
                'prop' => 'storageBuffer',
                'bindTo' => 'storageBuffer',
                'errorProp' => array('storageBuffer'),
            ),
            'Projects' => array(
                'prop' => 'projects',
                'bindTo' => 'projects',
                'errorProp' => array('projects'),
            ),
            'Linked Samples' => array(
                'prop' => 'linkedSamples',
                'bindTo' => 'linkedSamples',
                'errorProp' => array('linkedSamples'),
            ),
            'Division' => array(
                'prop' => 'division',
                'bindTo' => 'division.stringLabel',
                'errorProp' => array('division'),
            ),
            'Division Row' => array(
                'prop' => 'divisionRow',
                'bindTo' => 'divisionRow',
                'errorProp' => array('divisionRow', 'storageLocation'),
            ),
            'Division Column' => array(
                'prop' => 'divisionColumn',
                'bindTo' => 'divisionColumn',
                'errorProp' => array('divisionColumn', 'storageLocation'),
            ),
            'Sample Type' => array(
                'prop' => 'sampleType',
                'bindTo' => 'sampleType.name',
                'errorProp' => array('sampleType'),
            ),
            'Cell Line' => array(
                'prop' => 'cellLine',
                'bindTo' => 'cellLine',
                'errorProp' => array('cellLine'),
            )
        ),
        'Chemical Compound' => array(
            'Name' => array(
                'prop' => 'name',
                'bindTo' => 'name',
                'errorProp' => array('name'),
            ),
            'Description' => array(
                'prop' => 'description',
                'bindTo' => 'description',
                'errorProp' => array('description'),
            ),
            'Status' => array(
                'prop' => 'status',
                'bindTo' => 'status',
                'errorProp' => array('status'),
            ),
            'Storage Container' => array(
                'prop' => 'storageContainer',
                'bindTo' => 'storageContainer.name',
                'errorProp' => array('storageContainer'),
            ),
            'Storage Buffer' => array(
                'prop' => 'storageBuffer',
                'bindTo' => 'storageBuffer',
                'errorProp' => array('storageBuffer'),
            ),
            'Projects' => array(
                'prop' => 'projects',
                'bindTo' => 'projects',
                'errorProp' => array('projects'),
            ),
            'Linked Samples' => array(
                'prop' => 'linkedSamples',
                'bindTo' => 'linkedSamples',
                'errorProp' => array('linkedSamples'),
            ),
            'Division' => array(
                'prop' => 'division',
                'bindTo' => 'division.stringLabel',
                'errorProp' => array('division'),
            ),
            'Division Row' => array(
                'prop' => 'divisionRow',
                'bindTo' => 'divisionRow',
                'errorProp' => array('divisionRow', 'storageLocation'),
            ),
            'Division Column' => array(
                'prop' => 'divisionColumn',
                'bindTo' => 'divisionColumn',
                'errorProp' => array('divisionColumn', 'storageLocation'),
            ),
            'Sample Type' => array(
                'prop' => 'sampleType',
                'bindTo' => 'sampleType.name',
                'errorProp' => array('sampleType'),
            ),
            'Mass (g)' => array(
                'prop' => 'mass',
                'bindTo' => 'mass',
                'errorProp' => array('mass'),
            )
        ),
        'Solution' => array(
            'Name' => array(
                'prop' => 'name',
                'bindTo' => 'name',
                'errorProp' => array('name'),
            ),
            'Description' => array(
                'prop' => 'description',
                'bindTo' => 'description',
                'errorProp' => array('description'),
            ),
            'Status' => array(
                'prop' => 'status',
                'bindTo' => 'status',
                'errorProp' => array('status'),
            ),
            'Storage Container' => array(
                'prop' => 'storageContainer',
                'bindTo' => 'storageContainer.name',
                'errorProp' => array('storageContainer'),
            ),
            'Storage Buffer' => array(
                'prop' => 'storageBuffer',
                'bindTo' => 'storageBuffer',
                'errorProp' => array('storageBuffer'),
            ),
            'Projects' => array(
                'prop' => 'projects',
                'bindTo' => 'projects',
                'errorProp' => array('projects'),
            ),
            'Linked Samples' => array(
                'prop' => 'linkedSamples',
                'bindTo' => 'linkedSamples',
                'errorProp' => array('linkedSamples'),
            ),
            'Division' => array(
                'prop' => 'division',
                'bindTo' => 'division.stringLabel',
                'errorProp' => array('division'),
            ),
            'Division Row' => array(
                'prop' => 'divisionRow',
                'bindTo' => 'divisionRow',
                'errorProp' => array('divisionRow', 'storageLocation'),
            ),
            'Division Column' => array(
                'prop' => 'divisionColumn',
                'bindTo' => 'divisionColumn',
                'errorProp' => array('divisionColumn', 'storageLocation'),
            ),
            'Sample Type' => array(
                'prop' => 'sampleType',
                'bindTo' => 'sampleType.name',
                'errorProp' => array('sampleType'),
            )
        ),
        'Other' => array(
            'Name' => array(
                'prop' => 'name',
                'bindTo' => 'name',
                'errorProp' => array('name'),
            ),
            'Description' => array(
                'prop' => 'description',
                'bindTo' => 'description',
                'errorProp' => array('description'),
            ),
            'Status' => array(
                'prop' => 'status',
                'bindTo' => 'status',
                'errorProp' => array('status'),
            ),
            'Storage Container' => array(
                'prop' => 'storageContainer',
                'bindTo' => 'storageContainer.name',
                'errorProp' => array('storageContainer'),
            ),
            'Storage Buffer' => array(
                'prop' => 'storageBuffer',
                'bindTo' => 'storageBuffer',
                'errorProp' => array('storageBuffer'),
            ),
            'Projects' => array(
                'prop' => 'projects',
                'bindTo' => 'projects',
                'errorProp' => array('projects'),
            ),
            'Linked Samples' => array(
                'prop' => 'linkedSamples',
                'bindTo' => 'linkedSamples',
                'errorProp' => array('linkedSamples'),
            ),
            'Division' => array(
                'prop' => 'division',
                'bindTo' => 'division.stringLabel',
                'errorProp' => array('division'),
            ),
            'Division Row' => array(
                'prop' => 'divisionRow',
                'bindTo' => 'divisionRow',
                'errorProp' => array('divisionRow', 'storageLocation'),
            ),
            'Division Column' => array(
                'prop' => 'divisionColumn',
                'bindTo' => 'divisionColumn',
                'errorProp' => array('divisionColumn', 'storageLocation'),
            ),
            'Sample Type' => array(
                'prop' => 'sampleType',
                'bindTo' => 'sampleType.name',
                'errorProp' => array('sampleType'),
            )
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

    public function getFilter(SampleType $sampleType)
    {
        $filter = new ValidatorFilter($this->validator);

        $filter->add('name', new Assert\NotBlank());
        $filter->add('description', new Assert\NotBlank(array(
            'message' => 'description can not be blank',
        )));
        $filter->add('sampleType', new CarbonAssert\StringToObject(array(
            'objectName' => 'sampleType',
            'entity' => "AppBundle\\Entity\\Storage\\SampleType",
            'property' => 'name',
        )));
        $filter->add('linkedSamples', new Assert\Optional());
        $filter->add('projects', new Assert\Optional());
        $filter->add('status', new Assert\Choice(array(
            'choices' => array(
                'Available',
                'Depleted',
                'Destroyed',
                'Shipped'
            ),
            'message' => 'Invalid status {{ value }}'
        )));
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

        if ($sampleType->getName() == 'DNA') {

            $filter->add('vectorName', new Assert\NotBlank());
            $filter->add('concentration', new Assert\NotBlank());
            $filter->add('concentrationUnits', new Assert\Choice(array(
                'choices' => array(
                    'mg/mL',
                    'ng/uL',
                    'Molar',
                )
            )));
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

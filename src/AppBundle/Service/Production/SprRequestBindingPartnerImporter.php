<?php

namespace AppBundle\Service\Production;

use Carbon\ApiBundle\Validator\Constraints as CarbonAssert;
use Ddeboer\DataImport\Filter\ValidatorFilter;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validator\RecursiveValidator;

class SprRequestBindingPartnerImporter
{
    protected  $mapping = array(
        'Ligand' => array(
            'prop' => 'ligand',
            'bindTo' => 'ligand.id',
            'frontendBindTo' => 'ligand.stringLabel',
            'errorProp' => array('ligand'),
        ),
        'LigandMW' => array(
            'prop' => 'ligandMw',
            'bindTo' => 'ligandMw',
            'frontendBindTo' => 'ligandMw',
            'errorProp' => array('ligandMw'),
        ),
        'Analyte' => array(
            'prop' => 'analyte',
            'bindTo' => 'analyte.id',
            'frontendBindTo' => 'analyte.stringLabel',
            'errorProp' => array('analyte'),
        ),
        'AnalyteMW' => array(
            'prop' => 'analyteMw',
            'bindTo' => 'analyteMw',
            'frontendBindTo' => 'analyteMw',
            'errorProp' => array('analyteMw'),
        ),
        'AnalyteConc' => array(
            'prop' => 'analyteConcentration',
            'bindTo' => 'analyteConcentration',
            'frontendBindTo' => 'analyteConcentration',
            'errorProp' => array('analyteConcentration'),
        ),
        'Kon' => array(
            'prop' => 'kOn',
            'bindTo' => 'kOn',
            'frontendBindTo' => 'kOn',
            'errorProp' => array('kOn'),
        ),
        'Koff' => array(
            'prop' => 'kOff',
            'bindTo' => 'kOff',
            'frontendBindTo' => 'kOff',
            'errorProp' => array('kOff'),
        ),
        'KD' => array(
            'prop' => 'kD',
            'bindTo' => 'kD',
            'frontendBindTo' => 'kD',
            'errorProp' => array('kD'),
        ),
        'RmaxFit' => array(
            'prop' => 'rMaxFit',
            'bindTo' => 'rMaxFit',
            'frontendBindTo' => 'rMaxFit',
            'errorProp' => array('rMaxFit'),
        ),
        'RmaxExp' => array(
            'prop' => 'rMaxExp',
            'bindTo' => 'rMaxExp',
            'frontendBindTo' => 'rMaxExp',
            'errorProp' => array('rMaxExp'),
        ),
        'RmaxRatio' => array(
            'prop' => 'rMaxRatio',
            'bindTo' => 'rMaxRatio',
            'frontendBindTo' => 'rMaxRatio',
            'errorProp' => array('rMaxRatio'),
        ),
        'Signal' => array(
            'prop' => 'signal',
            'bindTo' => 'signal',
            'frontendBindTo' => 'signal',
            'errorProp' => array('signal'),
        ),
        'Level' => array(
            'prop' => 'level',
            'bindTo' => 'level',
            'frontendBindTo' => 'level',
            'errorProp' => array('level'),
        ),
        'SignalRatio' => array(
            'prop' => 'signalRatio',
            'bindTo' => 'signalRatio',
            'frontendBindTo' => 'signalRatio',
            'errorProp' => array('signalRatio'),
        ),
        'Chi2' => array(
            'prop' => 'chi2',
            'bindTo' => 'chi2',
            'frontendBindTo' => 'chi2',
            'errorProp' => array('chi2'),
        ),
        'NormChi2' => array(
            'prop' => 'normChi2',
            'bindTo' => 'normChi2',
            'frontendBindTo' => 'normChi2',
            'errorProp' => array('normChi2'),
        ),
        'Rmax_equil' => array(
            'prop' => 'rMaxEquil',
            'bindTo' => 'rMaxEquil',
            'frontendBindTo' => 'rMaxEquil',
            'errorProp' => array('rMaxEquil'),
        ),
        'KD_equil' => array(
            'prop' => 'kDEquil',
            'bindTo' => 'kDEquil',
            'frontendBindTo' => 'kDEquil',
            'errorProp' => array('kDEquil'),
        ),
        'RmaxYesNo' => array(
            'prop' => 'rMax',
            'bindTo' => 'rMax',
            'frontendBindTo' => 'rMax',
            'errorProp' => array('rMax'),
        ),
        'KonInRange' => array(
            'prop' => 'kOnInRange',
            'bindTo' => 'kOnInRange',
            'frontendBindTo' => 'kOnInRange',
            'errorProp' => array('kOnInRange'),
        ),
        'KoffInRange' => array(
            'prop' => 'kOffInRange',
            'bindTo' => 'kOffInRange',
            'frontendBindTo' => 'kOffInRange',
            'errorProp' => array('kOffInRange'),
        ),
        'Capture' => array(
            'prop' => 'capture',
            'bindTo' => 'capture',
            'frontendBindTo' => 'capture',
            'errorProp' => array('capture'),
        ),
        'CurveFit' => array(
            'prop' => 'curveFit',
            'bindTo' => 'curveFit',
            'frontendBindTo' => 'curveFit',
            'errorProp' => array('curveFit'),
        ),
        'EquilYesNo' => array(
            'prop' => 'equil',
            'bindTo' => 'equil',
            'frontendBindTo' => 'equil',
            'errorProp' => array('equil'),
        ),
        'KD_fix' => array(
            'prop' => 'kDFix',
            'bindTo' => 'kDFix',
            'frontendBindTo' => 'kDFix',
            'errorProp' => array('kDFix'),
        ),
    );

    public function __construct(RecursiveValidator $validator)
    {
        $this->validator = $validator;
    }

    public function getTemplateContent()
    {
        return implode(array_keys($this->mapping), ',');
    }

    public function getMapping(SampleType $sampleType)
    {
        return $this->mapping;
    }

    public function getFilter()
    {
        $filter = new ValidatorFilter($this->validator);


        return $filter;
    }
}

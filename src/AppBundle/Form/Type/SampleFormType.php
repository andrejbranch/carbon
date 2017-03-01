<?php

namespace AppBundle\Form\Type;

use AppBundle\Form\DataTransformer\SampleTypeTransformer;
use AppBundle\Form\DataTransformer\StorageContainerTransformer;
use AppBundle\Form\DataTransformer\LinkedSamplesTransformer;
use Carbon\ApiBundle\Form\DataTransformer\CryoblockOTOTransformer;
use Carbon\ApiBundle\Form\Type\CryoblockAbstractType;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SampleFormType extends CryoblockAbstractType
{
    private $class;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text')
            ->add('description', 'text')
            ->add('status', 'text')
            ->add('storageBuffer', 'text')
            ->add('vectorName', 'text')
            ->add('divisionRow', 'text')
            ->add('divisionColumn', 'integer')

            // dna
            ->add('concentration', 'number', array(
                'precision' => 3,
            ))
            ->add('concentrationUnits', 'text')
            ->add('dnaSequence', 'text')
            ->add('aminoAcidSequence', 'text')
            ->add('aminoAcidCount', 'integer')
            ->add('molecularWeight', 'number', array(
                'precision' => 3,
            ))
            ->add('extinctionCoefficient', 'number', array(
                'precision' => 3,
            ))
            ->add('purificationTags', 'text')

            ->add('division', 'entity', array(
                'class' => 'AppBundle:Storage\Division',
                'property' => 'division_id',
                'multiple' => false
            ))
            ->add('storageContainer', 'entity', array(
                'class' => 'AppBundle:Storage\StorageContainer',
                'multiple' => false,
            ))
            ->add('sampleType', 'entity', array(
                'class' => 'AppBundle:Storage\SampleType',
                'multiple' => false
            ))

            // sera
            ->add('species', 'text')

            // bacterial, yeast, & mammalian cells
            ->add('cellLine', 'text')

            // chemical compound
            ->add('mass', 'number', array(
                'precision' => 3,
            ))

            ->add('linkedSamples', 'hidden', array('mapped' => false))
        ;

        $builder->get('sampleType')
            ->addViewTransformer(new CryoblockOTOTransformer(
                $this->em, 'AppBundle:Storage\SampleType'
            ))
        ;

        $builder->get('storageContainer')
            ->addViewTransformer(new CryoblockOTOTransformer(
                $this->em, 'AppBundle:Storage\StorageContainer'
            ))
        ;

        $builder->get('linkedSamples')
            ->addViewTransformer(new LinkedSamplesTransformer($this->em, $builder->getForm()->getData()))
        ;

        $builder->get('division')
            ->addViewTransformer(new CryoblockOTOTransformer(
                $this->em, 'AppBundle:Storage\Division'
            ))
        ;

        parent::buildForm($builder, $options);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Storage\Sample',
            'csrf_protection' => false,
        ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $this->configureOptions($resolver);
    }

    public function getName()
    {
        return 'sample';
    }
}

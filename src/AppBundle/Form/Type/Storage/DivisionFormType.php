<?php

namespace AppBundle\Form\Type\Storage;

use Carbon\ApiBundle\Form\DataTransformer\CryoblockOTOTransformer;
use Doctrine\ORM\EntityManager;
use Carbon\ApiBundle\Form\Type\CryoblockAbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class DivisionFormType extends CryoblockAbstractType
{
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', 'text')
            ->add('description', 'text')
            ->add('hasDimension', 'checkbox')
            ->add('allowAllSampleTypes', 'checkbox')
            ->add('allowAllStorageContainers', 'checkbox')
            ->add('isPublicEdit', 'checkbox')
            ->add('isPublicView', 'checkbox')
            ->add('height', 'integer')
            ->add('width', 'integer')
            ->add('lft', 'integer')
            ->add('rgt', 'integer')
            ->add('parent', 'entity', array(
                'class' => 'AppBundle:Storage\Division',
                'property' => 'parent_id',
                'multiple' => false
            ))

            ->add('sampleTypes', 'cryoblock_mtm', array(
                'parent_object' => $builder->getForm()->getData(),
                'accessor' => 'divisionSampleTypes',
                'child_accessor' => 'sampleType'
            ))

            ->add('storageContainers', 'cryoblock_mtm', array(
                'parent_object' => $builder->getForm()->getData(),
                'accessor' => 'divisionStorageContainers',
                'child_accessor' => 'storageContainer'
            ))

            ->add('editors', 'cryoblock_mtm', array(
                'parent_object' => $builder->getForm()->getData(),
                'accessor' => 'divisionEditors',
                'child_accessor' => 'user'
            ))

            ->add('groupEditors', 'cryoblock_mtm', array(
                'parent_object' => $builder->getForm()->getData(),
                'accessor' => 'divisionGroupEditors',
                'child_accessor' => 'group'
            ))

            ->add('viewers', 'cryoblock_mtm', array(
                'parent_object' => $builder->getForm()->getData(),
                'accessor' => 'divisionViewers',
                'child_accessor' => 'user'
            ))

            ->add('groupViewers', 'cryoblock_mtm', array(
                'parent_object' => $builder->getForm()->getData(),
                'accessor' => 'divisionGroupViewers',
                'child_accessor' => 'group'
            ))

            ->add('path', 'hidden', array('mapped' => false))
            ->add('level', 'hidden', array('mapped' => false))
            ->add('id', 'hidden', array('mapped' => false))
            ->add('divisionStorageContainers', 'hidden', array('mapped' => false))
            ->add('divisionSampleTypes', 'hidden', array('mapped' => false))
            ->add('samples', 'hidden', array('mapped' => false))
            ->add('parentId', 'hidden', array('mapped' => false))
            ->add('availableSlots', 'hidden', array('mapped' => false))
            ->add('totalSlots', 'hidden', array('mapped' => false))
            ->add('usedSlots', 'hidden', array('mapped' => false))
            ->add('percentFull', 'hidden', array('mapped' => false))

            ->add('divisionEditors', 'hidden', array('mapped' => false))
            ->add('divisionGroupEditors', 'hidden', array('mapped' => false))
            ->add('divisionViewers', 'hidden', array('mapped' => false))
            ->add('divisionGroupViewers', 'hidden', array('mapped' => false))
        ;

        $builder->get('parent')
            ->addViewTransformer(new CryoblockOTOTransformer(
                $this->em, 'AppBundle:Storage\Division'
            ))
        ;

        parent::buildForm($builder, $options);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Storage\Division',
            'csrf_protection' => false,
        ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $this->configureOptions($resolver);
    }

    public function getName()
    {
        return 'division';
    }
}

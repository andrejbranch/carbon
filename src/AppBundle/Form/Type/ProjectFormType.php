<?php

namespace AppBundle\Form\Type;

use Carbon\ApiBundle\Form\DataTransformer\CryoblockOTOTransformer;
use Doctrine\ORM\EntityManager;
use Carbon\ApiBundle\Form\Type\CryoblockAbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProjectFormType extends CryoblockAbstractType
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
            ->add('samples', 'cryoblock_mtm', array(
                'parent_object' => $builder->getForm()->getData(),
                'accessor' => 'projectSamples',
                'child_accessor' => 'sample'
            ))
        ;


        parent::buildForm($builder, $options);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Project',
            'csrf_protection' => false,
        ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $this->configureOptions($resolver);
    }

    public function getName()
    {
        return 'project';
    }
}

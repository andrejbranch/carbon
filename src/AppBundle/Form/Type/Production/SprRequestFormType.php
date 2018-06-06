<?php

namespace AppBundle\Form\Type\Production;

use Carbon\ApiBundle\Form\DataTransformer\CryoblockOTOTransformer;
use Doctrine\ORM\EntityManager;
use Carbon\ApiBundle\Form\Type\CryoblockAbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SprRequestFormType extends CryoblockAbstractType
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
            ->add('protocol', 'entity', array(
                'class' => 'AppBundle:Storage\Protocol',
                'property' => 'protocol_id',
                'multiple' => false
            ))

            ->add('projects', 'cryoblock_mtm', array(
                'parent_object' => $builder->getForm()->getData(),
                'accessor' => 'requestProjects',
                'child_accessor' => 'project'
            ))

            ->add('bindingPartners', 'spr_binding_partner', array(
                'parent_object' => $builder->getForm()->getData(),
                'accessor' => 'requestBindingPartners',
            ))
        ;

        $builder->get('protocol')
            ->addViewTransformer(new CryoblockOTOTransformer(
                $this->em, 'AppBundle:Storage\Protocol'
            ))
        ;

        parent::buildForm($builder, $options);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Production\Analysis\SprRequest',
            'csrf_protection' => false,
        ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $this->configureOptions($resolver);
    }

    public function getName()
    {
        return 'Spr';
    }
}

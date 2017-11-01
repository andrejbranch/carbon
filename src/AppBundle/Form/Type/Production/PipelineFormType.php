<?php

namespace AppBundle\Form\Type\Production;

use Carbon\ApiBundle\Form\Type\CryoblockAbstractType;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PipelineFormType extends CryoblockAbstractType
{
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $em = $this->em;

        $builder->add('steps', 'pipeline_steps', array(
            'parent_object' => $builder->getForm()->getData(),
        ));

        parent::buildForm($builder, $options);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Production\Pipeline',
            'csrf_protection' => false,
        ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $this->configureOptions($resolver);
    }

    public function getName()
    {
        return 'pipeline';
    }
}

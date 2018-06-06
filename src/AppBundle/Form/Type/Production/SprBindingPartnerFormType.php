<?php

namespace AppBundle\Form\Type\Production;

use AppBundle\Entity\Production\Analysis\SprRequestBindingPartner;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\Serializer\NameConverter\CamelCaseToSnakeCaseNameConverter;

class SprBindingPartnerFormType extends AbstractType
{
    private $class;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $em = $this->em;

        $camelCaseConverter = new CamelCaseToSnakeCaseNameConverter();
        $propertyAccessor = PropertyAccess::createPropertyAccessor();

        $builder
            ->add('parentId', 'hidden', array('mapped' => false))
            ->add('removing', 'hidden', array('mapped' => false))
            ->add('adding', 'hidden', array('mapped' => false))
        ;

        $accessor = $options['accessor'];
        $parentObject = $options['parent_object'];
        $parentClass = get_class($parentObject);

        $preSubmit = function (FormEvent $event) use ($em, $parentObject) {

            $map = $event->getData();

            $addingItems = isset($map['adding']) ? $map['adding'] : array();
            $removingItems = isset($map['removing']) ? $map['removing'] : array();
            $parentId = $parentObject->getId();

            foreach ($removingItems as $removingItem) {

                $bindingPartner = $em->getRepository('AppBundle\Entity\Production\Analysis\SprRequestBindingPartner')->find($removingItem['id']);

                $em->remove($bindingPartner);


            }

            foreach ($addingItems as $addingItem) {

                $ligand = $em->getRepository('AppBundle\Entity\Storage\Sample')->find($addingItem['ligand']['id']);
                $analyte = $em->getRepository('AppBundle\Entity\Storage\Sample')->find($addingItem['analyte']['id']);
                $newBindingPartner = new SprRequestBindingPartner();
                $newBindingPartner->setRequest($parentObject);
                $newBindingPartner->setLigand($ligand);
                $newBindingPartner->setAnalyte($analyte);
                $newBindingPartner->setNumBindingSites(1);
                $em->persist($newBindingPartner);

            }

        };

        $builder->addEventListener(FormEvents::PRE_SUBMIT, $preSubmit);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'csrf_protection' => false,
        ));

        $resolver->setRequired(array(
            'parent_object', 'accessor',
        ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $this->configureOptions($resolver);
    }

    public function getName()
    {
        return 'spr_binding_partner';
    }
}

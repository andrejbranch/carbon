<?php

namespace AppBundle\Form\Type\Production;

use AppBundle\Entity\Production\Pipeline;
use AppBundle\Entity\Production\PipelineInputRequest;
use Carbon\ApiBundle\Entity\Production\BaseRequest;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\Serializer\NameConverter\CamelCaseToSnakeCaseNameConverter;


class PipelineStepsFormType extends AbstractType
{
    private $class;

    public function __construct(EntityManager $em, FormFactory $formFactory)
    {
        $this->em = $em;
        $this->formFactory = $formFactory;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $em = $this->em;
        $parentObject = $options['parent_object'];

        $preSubmit = function (FormEvent $event) use ($em, $builder, $parentObject) {

            $steps = $event->getData();
            $pipelineRequestRepository = $em->getRepository('AppBundle\\Entity\\Production\\PipelineRequest');

            $requestHashMapping = array();

            foreach ($steps as $stepIndex => $step) {

                foreach ($step['requests'] as $stepRequest) {

                    $pipelineRequest = $pipelineRequestRepository->findOneBy(array('name' => $stepRequest['name']));

                    $entityClass = $pipelineRequest->getEntity();

                    $entity = new $entityClass();

                    $form = $this->formFactory->create($pipelineRequest->getFormType(), $entity);
                    $form->submit($stepRequest['request'], true);

                    if (!$form->isValid()) {
                        var_dump('not valid');
                    }

                    $entity->setPipeline($parentObject);
                    $entity->setPipelineStep($stepIndex);
                    $entity->setStatus($stepIndex === 0 ? BaseRequest::STATUS_PENDING : BaseRequest::STATUS_PENDING_PIPELINE);

                    $em->persist($entity);

                    $requestHashMapping[$stepRequest['hashId']] = array(
                        'id' => $entity->getId(),
                        'pipelineRequest' => $pipelineRequest,
                    );

                    foreach ($stepRequest['inputRequests'] as $inputRequestHashId) {

                        $pipelineInputRequest = new PipelineInputRequest();

                        $pipelineInputRequest
                            ->setFromPipelineRequest($requestHashMapping[$inputRequestHashId]['pipelineRequest'])
                            ->setFromRequestId($requestHashMapping[$inputRequestHashId]['id'])
                            ->setToPipelineRequest($pipelineRequest)
                            ->setToRequestId($entity->getId())
                        ;

                        $em->persist($pipelineInputRequest);

                    }

                }

            }

        };

        $builder->addEventListener(FormEvents::PRE_SUBMIT, $preSubmit);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'csrf_protection' => false,
            'allow_extra_fields' => true
        ));

        $resolver->setRequired(array('parent_object'));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $this->configureOptions($resolver);
    }

    public function getName()
    {
        return 'pipeline_steps';
    }
}

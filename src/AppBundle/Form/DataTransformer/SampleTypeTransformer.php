<?php

namespace AppBundle\Form\DataTransformer;

use AppBundle\Entity\SampleType;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class SampleTypeTransformer implements DataTransformerInterface
{
    private $manager;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * Do nothing on transform
     *
     * @param  SampleType|null $sampleType
     *
     * @return SampleType
     */
    public function transform($sampleType)
    {
        return $sampleType;
    }

    /**
     * Transforms an array to an object (SampleType).
     *
     * @param  array $sampleTypeArray
     *
     * @return Issue|null
     *
     * @throws TransformationFailedException if object (SampleType) is not found.
     */
    public function reverseTransform($sampleTypeArray)
    {
        if (!$sampleTypeArray) {
            return;
        }

        $sampleType = $this->em->getRepository('AppBundle:SampleType')
            ->find($sampleTypeArray['id'])
        ;

        if (NULL === $sampleType) {
            throw new TransformationFailedException(sprintf(
                'Sample type with id %s does not exist',
                $sampleTypeArray['id']
            ));
        }

        return $sampleType->getId();
    }
}

<?php

namespace AppBundle\Form\DataTransformer;

use AppBundle\Entity\Sample;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class LinkedSamplesTransformer implements DataTransformerInterface
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
    public function transform($sample)
    {
        return $sample;
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
    public function reverseTransform($samplesArray)
    {
        if (empty($samplesArray)) {
            return $samplesArray;
        }

        $samples = array();

        foreach ($samplesArray as $sample) {

            $sample = $this->em->getRepository('AppBundle:Sample')
                ->find($sample['id'])
            ;

            if (NULL === $sample) {
                throw new TransformationFailedException(sprintf(
                    'Sample with id %s does not exist', $sample['id']
                ));
            }

            $samples[] = $sample->getId();

        }

        return $samples;
    }
}

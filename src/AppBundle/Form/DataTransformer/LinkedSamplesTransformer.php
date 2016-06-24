<?php

namespace AppBundle\Form\DataTransformer;

use AppBundle\Entity\SampleLinkedSample;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class LinkedSamplesTransformer implements DataTransformerInterface
{
    private $manager;

    public function __construct(EntityManager $em, $sample)
    {
        $this->em = $em;
        $this->parentSample = $sample;
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
    public function reverseTransform($linkedSamplesMap)
    {
        $removingIds = isset($linkedSamplesMap['removing']) ? $linkedSamplesMap['removing'] : array();
        $addingIds = isset($linkedSamplesMap['adding']) ? $linkedSamplesMap['adding'] : array();
        $parentId = $this->parentSample->getId();

        if (empty($removingIds) && empty($addingIds)) {
            return;
        }

        $repo = $this->em->getRepository('AppBundle:SampleLinkedSample');

        foreach ($removingIds as $removingId) {

            $sampleLinkedSample = $repo->find(array(
                'parentSample' => $parentId,
                'childSample' => $removingId
            ));

            if ($sampleLinkedSample) {

                $this->em->remove($sampleLinkedSample);

            }

            $sampleLinkedSample = $repo->find(array(
                'parentSample' => $removingId,
                'childSample' => $parentId
            ));

            if ($sampleLinkedSample) {

                $this->em->remove($sampleLinkedSample);

            }

        }

        foreach ($addingIds as $addingId) {

            $sampleLinkedSample = new SampleLinkedSample();

            $sampleLinkedSample2 = new SampleLinkedSample();

            $sampleRepo = $this->em->getRepository('AppBundle:Sample');

            // $parentSample = $sampleRepo->find($parentId);
            $parentSample = $this->parentSample;
            $childSample = $sampleRepo->find($addingId);

            $sampleLinkedSample->setParentSample($parentSample);
            $sampleLinkedSample->setChildSample($childSample);

            $sampleLinkedSample2->setParentSample($childSample);
            $sampleLinkedSample2->setChildSample($parentSample);

            $this->em->persist($sampleLinkedSample);
            $this->em->persist($sampleLinkedSample2);

        }

    }
}

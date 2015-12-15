<?php

namespace AppBundle\Form\DataTransformer;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class StorageContainerTransformer implements DataTransformerInterface
{
    private $manager;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * Do nothing on transform
     *
     * @param  StorageContainer|null storageContainer$
     *
     * @returnStorageContainer
     */
    public function transform($storageContainer)
    {
        return $storageContainer;
    }

    /**
     * Transforms an array to an object (StorageContainer).
     *
     * @param  array $storageContainerArray
     *
     * @return Issue|null
     *
     * @throws TransformationFailedException if object (StorageContainer) is not found.
     */
    public function reverseTransform($storageContainerArray)
    {
        if (!$storageContainerArray) {
            return;
        }

        $storageContainer = $this->em->getRepository('AppBundle:StorageContainer')
            ->find($storageContainerArray['id'])
        ;

        if (NULL === $storageContainer) {
            throw new TransformationFailedException(sprintf(
                'Sample type with id %s does not exist',
                $storageContainerArray['id']
            ));
        }

        return $storageContainer->getId();
    }
}

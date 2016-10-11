<?php

namespace AppBundle\Service\Import;

use Ddeboer\DataImport\Writer\DoctrineWriter;
use Doctrine\ORM\EntityManager;

class CryoblockDoctrineWriter extends DoctrineWriter
{
    /**
     * To flush entities or not. Use flush false if
     * you only want to validate the import and not save
     *
     * @var boolean
     */
    protected $flush;

    /**
     * Constructor
     *
     * @param EntityManager $entityManager
     * @param string        $entityName
     * @param string        $index         Index to find current entities by
     */
    public function __construct(EntityManager $entityManager, $entityName, $index = null, $flush = true)
    {
        $this->flush = (bool) $flush;

        parent::__construct($entityManager, $entityName, $index);
    }

    /**
     * {@inheritdoc}
     */
    public function writeItem(array $item)
    {
        $this->counter++;
        $entity = null;

        // If the table was not truncated to begin with, find current entities
        // first
        if (false === $this->truncate) {
            if ($this->index) {
                $entity = $this->entityRepository->findOneBy(
                    array($this->index => $item[$this->index])
                );
            } else {
                $entity = $this->entityRepository->find(current($item));
            }
        }

        if (!$entity) {
            $className = $this->entityMetadata->getName();
            $entity = $this->getNewInstance($className, $item);
        }

        $fieldNames = array_merge($this->entityMetadata->getFieldNames(), $this->entityMetadata->getAssociationNames());
        foreach ($fieldNames as $fieldName) {

            $value = null;
            if (isset($item[$fieldName])) {
                $value = $item[$fieldName];
            } elseif (method_exists($item, 'get' . ucfirst($fieldName))) {
                $value = $item->{'get' . ucfirst($fieldName)};
            }

            if (null === $value) {
                continue;
            }

            if (!($value instanceof \DateTime)
                || $value != $this->entityMetadata->getFieldValue($entity, $fieldName)
            ) {
                $setter = 'set' . ucfirst($fieldName);
                $this->setValue($entity, $value, $setter);
            }
        }

        $this->entityManager->persist($entity);

        if (($this->counter % $this->batchSize) == 0) {
            $this->entityManager->flush();
            $this->entityManager->clear();
        }

        return $entity;
    }

    /**
     * Override doctrine writer finish method to allow
     * prevention of flushing the entities
     *
     * @return Self
     */
    public function finish()
    {
        if ($this->flush) {
            $this->entityManager->flush();
        }

        $this->entityManager->clear();
        $this->reEnableLogging();

        return $this;
    }
}

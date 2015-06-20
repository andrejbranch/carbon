<?php

namespace Carbon\ApiBundle\Service;

use Carbon\ApiBundle\Annotation\Searchable;
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\ORM\Mapping\Column;

class CarbonAnnotationReader
{
    /**
     * Get column names for an entity.
     *
     * @return array
     */
    public function getEntityColumnNames($entityClass)
    {
        $columns = array();
        $reflClass = $this->getEntityReflectionClass($entityClass);
        $reader = $this->getReader();
        foreach ($reflClass->getProperties() as $property) {
            $annotations = $reader->getPropertyAnnotations($property);
            foreach ($annotations as $annotation) {
                if ($annotation instanceof Column) {
                    $columns[] = $annotation->name ?: $property->name;
                }
            }
        }

        return $columns;
    }

    /**
     * Get searchable columns for an entity.
     *
     * @param  string $entityClassName
     * @return array
     */
    protected function getSearchableColumns($entityClassName)
    {
        $searchableColumns = array();
        $reflClass = $this->getEntityReflectionClass($entityClassName);
        $reader = $this->getReader();
        foreach ($reflClass->getProperties() as $property) {
            $annotations = $reader->getPropertyAnnotations($property);
            foreach ($annotations as $annotation) {
                if ($annotation instanceof Searchable) {
                    $searchableColumns[] = $annotation->name;
                }
            }
        }

        return $searchableColumns;
    }

    /**
     * Get annotation reader
     *
     * @return Doctrine\Common\Annotations\AnnotationReader
     */
    protected function getReader()
    {
        return new AnnotationReader();
    }

    /**
     * Get reflection class for the entity
     *
     * @param  string $className the entities namespace
     * @return \ReflectionClass
     */
    protected function getEntityReflectionClass($className)
    {
        return new \ReflectionClass($className);
    }
}

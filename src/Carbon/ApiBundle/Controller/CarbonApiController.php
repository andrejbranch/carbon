<?php

namespace Carbon\ApiBundle\Controller;

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\ORM\Mapping\Column;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

/**
 * Abstract class to be extended by all api resources
 *
 * @author Andre Jon Branchizio <andrejbranch@gmail.com>
 * @version 1.01
 */
abstract class CarbonApiController extends Controller
{
    /**
     * Handles the HTTP GET for any resource/entity
     *
     * @return Symfony\Component\HttpFoundation\Response response with serialized resources
     */
    protected function handleGet()
    {
        $entityRepository = $this->getEntityRepository();

        $request = $this->getRequest();

        $data = $this->getSerializationHelper()->serialize(
            $this->getGrid()->getResult(
                $this->getEntityRepository()
            ),
            $request
        );

        return new Response($data);
    }

    /**
     * Default post handling for resource creation
     *
     * @return Symfony\Component\HttpFoundation\Response
     */
    protected function handlePost()
    {
        $entityClass = $this->getEntityClass();
        $entity = new $entityClass();

        $formBuilder = $this->createFormBuilder($entity, array(
            'csrf_protection' => false,
        ));

        foreach ($this->getEntityColumnNames() as $columnName) {
            $formBuilder->add($columnName);
        }

        $form = $formBuilder->getForm();

        $form->handleRequest($this->getRequest());

        if (!$form->isValid()) {
            return new Response($form->getErrorsAsString(), 401);
        }

        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush();

        return new Response($this->getSerializationHelper()->serialize($entity));
    }

    /**
     * Default put handling for resource update
     *
     * @return Symfony\Component\HttpFoundation\Response
     */
    protected function handlePut($key)
    {
        $entity = $this->getEntityRepository()->find($key);

        if (!$entity) {
            return new Response(sprintf('No entity found with primary key %s', $key ), 401);
        }

        $formBuilder = $this->createFormBuilder($entity, array(
            'csrf_protection' => false,
        ));

        foreach ($this->getEntityColumnNames() as $columnName) {
            $formBuilder->add($columnName);
        }

        $form = $formBuilder->getForm();

        $form->handleRequest($this->getRequest());

        if (!$form->isValid()) {
            return new Response($form->getErrorsAsString(), 401);
        }

        $this->getEntityManager()->flush();

        return new Response($this->getSerializationHelper()->serialize($entity));
    }

    /**
     * Get the doctrine entity manager
     *
     * @return Doctrine\ORM\EntityManager
     */
    protected function getEntityManager()
    {
        return $this->get('doctrine.orm.default_entity_manager');
    }

    /**
     * Get the entity class defined in controller constant
     *
     * @throws \LogicException
     * @return string
     */
    protected function getEntityClass()
    {
        if (!defined('static::RESOURCE_ENTITY')) {
            throw new \LogicException('No resource entity is defined. Did you add the RESOURCE_ENTITY const to your resource controller?');
        }

        return static::RESOURCE_ENTITY;
    }

    /**
     * Get the repository class for the given resource/entity
     *
     * @return Doctrine\ORM\EntityRepository
     */
    protected function getEntityRepository()
    {

        return $this->getEntityManager()->getRepository($this->getEntityClass());
    }

    /**
     * Get the serialization helper
     *
     * @return Carbon\ApiBundle\Service\Serialization\Helper
     */
    protected function getSerializationHelper()
    {
        return $this->get('carbon_api.serialization_helper');
    }

    /**
     * Get Carbon Grid
     *
     * @return Carbon\ApiBundle\Grid\CarbonGrid
     */
    protected function getGrid()
    {
        return $this->get('carbon_api.grid');
    }

    /**
     * Get column names for the entity.
     *
     * @return array
     */
    protected function getEntityColumnNames()
    {
        $columns = array();
        $reflClass = $this->getEntityReflectionClass($this->getEntityClass());
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

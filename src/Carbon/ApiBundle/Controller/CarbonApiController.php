<?php

namespace Carbon\ApiBundle\Controller;

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
    protected function _handleGet()
    {
        $entityRepository = $this->_getEntityRepository();

        $result = $this->_findEntities(
            $entityRepository,
            $this->getRequest()->query->all()
        );

        $data = $this->_getSerializer()->serialize($result, 'json');

        return new Response($data);
    }

    /**
     * Find a resource(s) based on an array of params
     *
     * @param  Doctrine\ORM\EntityRepository $entityRepository
     * @param  array $params
     * @return array of entities found
     */
    protected function _findEntities($entityRepository, $params)
    {
        return $this->get('carbon_api.query_builder')->buildQuery($entityRepository, $params);
    }

    /**
     * Get the repository class for the given resource/entity
     *
     * @return Doctrine\ORM\EntityRepository
     */
    protected function _getEntityRepository()
    {
        if (!defined('static::RESOURCE_ENTITY')) {
            throw new \LogicException('No resource entity is defined. Did you add the RESOURCE_ENTITY const to your resource controller?');
        }

        return $this->_getEntityManager()->getRepository(static::RESOURCE_ENTITY);
    }

    /**
     * Get the doctrine entity manager
     *
     * @return Doctrine\ORM\EntityManager
     */
    protected function _getEntityManager()
    {
        return $this->get('doctrine.orm.default_entity_manager');
    }

    /**
     * Get JMS Serializer
     *
     * @return JMS\Serializer\Serializer;
     */
    protected function _getSerializer()
    {
        return $this->get('jms_serializer');
    }
}

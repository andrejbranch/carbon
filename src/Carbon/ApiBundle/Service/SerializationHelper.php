<?php

namespace Carbon\ApiBundle\Service;

use JMS\Serializer\Serializer;
use JMS\Serializer\SerializationContext;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Builds the SerializationContext from GET Parameters
 */
class SerializationHelper
{
    /**
     * HEADER name for specific serialization groups used by JMSSerializer
     *
     * @var string
     */
    const HEADER_SERIALIZATION_GROUPS = 'X-CARBON_SERIALIZATION_GROUPS';

    /**
     * @var JMS\Serializer\Serializer
     */
    protected $serializer;

    /**
     * @var Symfony\Component\HttpFoundation\Request
     */
    protected $request;

    /**
     * Initializes a new SerializationHelper instance
     *
     * @param JMS\Serializer\Serializer $serializer
     */
    public function __construct(Serializer $serializer, RequestStack $requestStack)
    {
        $this->serializer = $serializer;
        $this->request = $requestStack->getCurrentRequest();
    }

    public function serialize($data)
    {
        return $this->serializer->serialize($data, 'json', $this->buildSerializationContext());
    }

    /**
     * Builds the JMSSerializationContext from GET request params
     * and unsets the params from the request
     *
     * @return JMS\Serializer\SerializationContext
     */
    protected function buildSerializationContext()
    {
        $context = new SerializationContext();

        $serializationGroups = $this->request->headers->get(self::HEADER_SERIALIZATION_GROUPS);

        if (isset($serializationGroups)) {
            $serializationGroups = explode(',', $serializationGroups);
            $context
                ->setGroups($serializationGroups)
                ->enableMaxDepthChecks()
            ;
        }

        return $context;
    }
}

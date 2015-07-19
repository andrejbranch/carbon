<?php

namespace Carbon\ApiBundle\Listener;

use Oneup\UploaderBundle\Event\PostPersistEvent;
use Symfony\Component\DependencyInjection\Container;

class PostUploadListener
{
    protected $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function onPostUpload(PostPersistEvent $event)
    {
        $logger = $this->container->get('logger');

        $user = $this->container->get('security.context')->getToken()->getUser();

        $file = $event->getFile();

        // $subject = $event->getSubject();
        $this->container->get('logger')->info(sprintf('PostUploadListener: %s', $file->getFilename()));

        $user->setAvatarPath($file->getFilename());

        $em = $this->container->get('doctrine.orm.default_entity_manager');

        $em->persist($user);
        $em->flush();
    }
}

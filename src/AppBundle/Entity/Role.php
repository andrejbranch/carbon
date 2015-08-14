<?php

namespace AppBundle\Entity;

use Carbon\ApiBundle\Entity\Role as BaseRole;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation AS JMS;

/**
 * @ORM\Entity()
 * @ORM\Table(name="role")
 */
class Role extends BaseRole
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @JMS\Groups({"default"})
     */
    protected $id;
}

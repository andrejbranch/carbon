<?php

namespace AppBundle\Entity;

use Carbon\ApiBundle\Annotation AS Carbon;
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

    /**
     * @ORM\Column(type="string", name="role", unique=true)
     * @Carbon\Searchable(name="role")
     * @JMS\Groups({"default"})
     */
    protected $role;

    /**
     * @JMS\VirtualProperty()
     * @JMS\Groups({"default"})
     */
    public function getStringLabel()
    {
        return $this->id . ': ' . $this->getRole();
    }
}

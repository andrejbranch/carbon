<?php

namespace Carbon\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;
use Symfony\Component\Security\Core\Role\RoleInterface;

/**
 * Role Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="role")
 */
class Role implements RoleInterface
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer", name="id")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Groups({"default"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", name="role", unique=true)
     * @Groups({"default"})
     */
    private $role;

    /**
     * Populate the role field
     *
     * @param string $role ROLE_FOO etc
     */
    public function __construct($role)
    {
        $this->role = $role;
    }

    /**
     * Return the role field.
     *
     * @return string
     */
    public function getRole()
    {
        return $this->role;
    }
}

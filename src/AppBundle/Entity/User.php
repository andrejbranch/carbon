<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping AS ORM;
use Carbon\ApiBundle\Entity\CarbonUser;
use JMS\Serializer\Annotation as JMS;

/**
 * @ORM\Entity()
 * @ORM\Table(name="user")
 * @JMS\ExclusionPolicy("all")
 *
 * The entity model for a user
 *
 * @version 1.01
 * @author Andre Jon Branchizio <andrejbranch@gmail.com>
 */
class User extends CarbonUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     * @JMS\Expose()
     * @JMS\Groups("default")
     */
    protected $id;

    protected $roles = array();

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\UserGroup", mappedBy="user")
     */
    protected $userGroups;

    public function __construct()
    {
        parent::__construct();

        $this->userGroups = new ArrayCollection();
    }

    /**
     * Returns the user roles
     *
     * @JMS\VirtualProperty()
     * @JMS\Groups("default")
     *
     * @return array The roles
     */
    public function getRoles()
    {
        $roles = $this->roles;

        foreach ($this->userGroups as $userGroup) {

            if ($groupRoles = $userGroup->getGroup()->getRoles()) {

                $roles = array_merge($roles, array_map(function ($role) {
                    return $role->getRole();
                }, $groupRoles));
            }
        }

        return array_unique($roles);
    }

    /**
     * @JMS\VirtualProperty()
     * @JMS\Groups({"default"})
     */
    public function getStringLabel()
    {
        return $this->getFullName();
    }
}

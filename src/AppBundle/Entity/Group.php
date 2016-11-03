<?php

namespace AppBundle\Entity;

use Carbon\ApiBundle\Annotation AS Carbon;
use Carbon\ApiBundle\Entity\Group as BaseGroup;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation AS JMS;

/**
 * @ORM\Entity
 * @ORM\Table(name="carbon_group")
 */
class Group extends BaseGroup
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @JMS\Groups({"default"})
     */
    protected $id;

    /**
     * @Carbon\Searchable(name="name")
     * @JMS\Groups({"default"})
     */
    protected $name;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\GroupRole", mappedBy="group")
     */
    protected $groupRoles;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\UserGroup", mappedBy="group")
     */
    protected $groupUsers;

    public $users;

    public function __construct()
    {
        $this->groupRoles = new ArrayCollection();
        $this->groupUsers = new ArrayCollection();
    }

    /**
     * @JMS\VirtualProperty()
     * @JMS\Groups({"default"})
     *
     * @return [type] [description]
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @JMS\VirtualProperty()
     * @JMS\Groups({"default"})
     */
    public function getStringLabel()
    {
        return $this->getName();
    }

    public function getGroupUsers()
    {
        return $this->groupUsers;
    }
}

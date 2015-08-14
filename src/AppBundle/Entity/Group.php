<?php

namespace AppBundle\Entity;

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
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Role")
     * @ORM\JoinTable(name="group_role")
     */
    protected $roles;

    public function __construct()
    {
        parent::__construct();

        $this->roles = new ArrayCollection();
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
}

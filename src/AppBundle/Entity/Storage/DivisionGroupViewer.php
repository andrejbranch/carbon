<?php

namespace AppBundle\Entity\Storage;

use Carbon\ApiBundle\Annotation AS Carbon;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use JMS\Serializer\Annotation AS JMS;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Division Group Viewer
 *
 * @ORM\Entity()
 * @ORM\Table(name="storage.division_group_viewer", schema="storage")
 */
class DivisionGroupViewer
{
    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @JMS\Groups({"default"})
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="group_id", type="integer")
     * @JMS\Groups({"default"})
     */
    private $groupId;

    /**
     * @ORM\ManyToOne(targetEntity="Carbon\ApiBundle\Entity\Group")
     * @ORM\JoinColumn(name="group_id", nullable=false)
     * @JMS\Groups({"default"})
     */
    private $group;

    /**
     * @var integer
     *
     * @ORM\Column(name="division_id", type="integer")
     * @JMS\Groups({"default"})
     */
    private $divisionId;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Storage\Division", inversedBy="divisionGroupEditors")
     * @ORM\JoinColumn(name="division_id", nullable=false)
     * @JMS\Groups({"default"})
     */
    private $division;

    /**
     * Gets the value of id.
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Sets the value of id.
     *
     * @param integer $id the id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Gets the value of divisionId.
     *
     * @return integer
     */
    public function getDivisionId()
    {
        return $this->divisionId;
    }

    /**
     * Sets the value of divisionId.
     *
     * @param integer $divisionId the division id
     *
     * @return self
     */
    public function setDivisionId($divisionId)
    {
        $this->divisionId = $divisionId;

        return $this;
    }

    /**
     * Gets the value of division.
     *
     * @return mixed
     */
    public function getDivision()
    {
        return $this->division;
    }

    /**
     * Sets the value of division.
     *
     * @param mixed $division the division
     *
     * @return self
     */
    public function setDivision($division)
    {
        $this->division = $division;

        return $this;
    }

    /**
     * Gets the value of groupId.
     *
     * @return integer
     */
    public function getGroupId()
    {
        return $this->groupId;
    }

    /**
     * Sets the value of groupId.
     *
     * @param integer $groupId the group id
     *
     * @return self
     */
    public function setGroupId($groupId)
    {
        $this->groupId = $groupId;

        return $this;
    }

    /**
     * Gets the value of group.
     *
     * @return mixed
     */
    public function getGroup()
    {
        return $this->group;
    }

    /**
     * Sets the value of group.
     *
     * @param mixed $group the group
     *
     * @return self
     */
    public function setGroup($group)
    {
        $this->group = $group;

        return $this;
    }
}
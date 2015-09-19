<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use JMS\Serializer\Annotation AS JMS;

/**
 * Sample
 *
 * @ORM\Entity(repositoryClass="AppBundle\Entity\SampleRepository")
 */
class Sample
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @JMS\Groups({"default"})
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=300)
     * @JMS\Groups({"default"})
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     * @JMS\Groups({"default"})
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="notes", type="text", nullable=true)
     * @JMS\Groups({"default"})
     */
    private $notes;

    /**
     * @var User $createdBy
     *
     * @Gedmo\Blameable(on="create")
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumn(name="created_by_id", referencedColumnName="id")
     * @JMS\Groups({"default"})
     * @JMS\MaxDepth(1)
     */
    private $createdBy;

    /**
     * @var User $updatedBy
     *
     * @Gedmo\Blameable(on="update")
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumn(name="updated_by_id", referencedColumnName="id")
     * @JMS\Groups({"default"})
     * @JMS\MaxDepth(1)
     */
    private $updatedBy;

    /**
     * @var integer
     *
     * @ORM\Column(name="division_id", type="integer")
     * @JMS\Groups({"default"})
     */
    private $divisionId;

    /**
     * @var \stdClass
     *
     * @ORM\Column(name="division", type="object")
     */
    /**
     * @ORM\ManyToOne(targetEntity="Division", inversedBy="samples")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="division_id", referencedColumnName="id")
     * })
     * @JMS\Groups({"default"})
     */
    private $division;

    /**
     * @var string
     *
     * @ORM\Column(name="division_row", type="string", length=1)
     * @JMS\Groups({"default"})
     */
    private $divisionRow;

    /**
     * @var integer
     *
     * @ORM\Column(name="division_column", type="integer", length=1)
     * @JMS\Groups({"default"})
     */
    private $divisionColumn;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set divisionId
     *
     * @param integer $divisionId
     * @return Sample
     */
    public function setDivisionId($divisionId)
    {
        $this->divisionId = $divisionId;

        return $this;
    }

    /**
     * Get divisionId
     *
     * @return integer
     */
    public function getDivisionId()
    {
        return $this->divisionId;
    }

    /**
     * Set division
     *
     * @param \stdClass $division
     * @return Sample
     */
    public function setDivision($division)
    {
        $this->division = $division;

        return $this;
    }

    /**
     * Get division
     *
     * @return \stdClass
     */
    public function getDivision()
    {
        return $this->division;
    }

    /**
     * Set divisionRow
     *
     * @param string $divisionRow
     * @return Sample
     */
    public function setDivisionRow($divisionRow)
    {
        $this->divisionRow = $divisionRow;

        return $this;
    }

    /**
     * Get divisionRow
     *
     * @return string
     */
    public function getDivisionRow()
    {
        return $this->divisionRow;
    }

    /**
     * Set divisionColumn
     *
     * @param integer $divisionColumn
     * @return Sample
     */
    public function setDivisionColumn($divisionColumn)
    {
        $this->divisionColumn = $divisionColumn;

        return $this;
    }

    /**
     * Get divisionColumn
     *
     * @return integer
     */
    public function getDivisionColumn()
    {
        return $this->divisionColumn;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Sample
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Sample
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get created by user
     *
     * @return AppBundle\Entity\User
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * Get updated by user
     *
     * @return AppBundle\Entity\User
     */
    public function getUpdatedBy()
    {
        return $this->updateBy;
    }

    /**
     * Get notes
     *
     * @return string
     */
    public function getNotes()
    {
        return $this->notes;
    }
}

<?php

namespace AppBundle\Entity;

use Carbon\ApiBundle\Annotation AS Carbon;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation AS JMS;

/**
 * Project
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\ProjectRepository")
 */
class Project
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
     * @Carbon\Searchable("name")
     * @ORM\Column(name="name", type="string", length=300)
     * @JMS\Groups({"default"})
     */
    private $name;

    /**
     * @var string
     *
     * @Carbon\Searchable("name")
     * @ORM\Column(name="description", type="text")
     * @JMS\Groups({"default"})
     */
    private $description;

    /**
     * @var string
     *
     * @Carbon\Searchable("name")
     * @ORM\Column(name="notes", type="text")
     * @JMS\Groups({"default"})
     */
    private $notes;

    /**
     * @var string
     *
     * @Carbon\Searchable("name")
     * @ORM\Column(name="status", type="string", length=255)
     * @JMS\Groups({"default"})
     */
    private $status;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_created_by", type="integer")
     * @JMS\Groups({"default"})
     */
    private $idCreatedBy;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_created", type="datetime")
     * @JMS\Groups({"default"})
     */
    private $dateCreated;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_updated", type="datetime")
     * @JMS\Groups({"default"})
     */
    private $dateUpdated;


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
     * Set name
     *
     * @param string $name
     * @return Project
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
     * Set description
     *
     * @param string $description
     * @return Project
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
     * Set notes
     *
     * @param string $notes
     * @return Project
     */
    public function setNotes($notes)
    {
        $this->notes = $notes;

        return $this;
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

    /**
     * Set status
     *
     * @param string $status
     * @return Project
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set idCreatedBy
     *
     * @param integer $idCreatedBy
     * @return Project
     */
    public function setIdCreatedBy($idCreatedBy)
    {
        $this->idCreatedBy = $idCreatedBy;

        return $this;
    }

    /**
     * Get idCreatedBy
     *
     * @return integer
     */
    public function getIdCreatedBy()
    {
        return $this->idCreatedBy;
    }

    /**
     * Set dateCreated
     *
     * @param \DateTime $dateCreated
     * @return Project
     */
    public function setDateCreated($dateCreated)
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }

    /**
     * Get dateCreated
     *
     * @return \DateTime
     */
    public function getDateCreated()
    {
        return $this->dateCreated;
    }

    /**
     * Set dateUpdated
     *
     * @param \DateTime $dateUpdated
     * @return Project
     */
    public function setDateUpdated($dateUpdated)
    {
        $this->dateUpdated = $dateUpdated;

        return $this;
    }

    /**
     * Get dateUpdated
     *
     * @return \DateTime
     */
    public function getDateUpdated()
    {
        return $this->dateUpdated;
    }
}

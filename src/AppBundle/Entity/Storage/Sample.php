<?php

namespace AppBundle\Entity\Storage;

use Carbon\ApiBundle\Annotation AS Carbon;
use Carbon\ApiBundle\Entity\Storage\BaseSample;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use JMS\Serializer\Annotation AS JMS;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Sample
 *
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Storage\SampleRepository")
 * @ORM\Table(name="storage.sample", schema="storage")
 * @Gedmo\Loggable
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false)
 */
class Sample extends BaseSample
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @JMS\Groups({"default"})
     */
    protected $id;

    /**
     * @var \DateTime $archivedAt
     *
     * @ORM\Column(name="archived_at", type="datetime", nullable=true)
     * @Gedmo\Versioned
     * @JMS\Groups({"default"})
     */
    protected $archivedAt;

    /**
     * @var string $storageBuffer
     *
     * @ORM\Column(name="storage_buffer", type="string", length=300, nullable=true)
     * @JMS\Groups({"default"})
     * @Gedmo\Versioned
     */
    protected $storageBuffer;

    /**
     * @var Protocol $protocol
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Storage\Protocol")
     * @ORM\JoinColumn(name="protocol_id", referencedColumnName="id")
     * @Gedmo\Versioned
     * @JMS\Groups({"default"})
     */
    protected $protocol;

    /**
     * @var string $vectorName
     *
     * @ORM\Column(name="vector_name", type="string", nullable=true, length=150)
     * @JMS\Groups({"default"})
     * @Gedmo\Versioned
     */
    protected $vectorName;

    /**
     * @var string $dnaSequence
     *
     * @ORM\Column(name="dna_sequence", type="text", nullable=true)
     * @JMS\Groups({"default"})
     * @Gedmo\Versioned
     */
    protected $dnaSequence;

    /**
     * @var string $aminoAcidSequence
     *
     * @ORM\Column(name="amino_acid_sequence", type="text", nullable=true)
     * @JMS\Groups({"default"})
     * @Gedmo\Versioned
     */
    protected $aminoAcidSequence;

    /**
     * @var string $aminoAcidCount
     *
     * @ORM\Column(name="amino_acid_count", type="integer", nullable=true)
     * @JMS\Groups({"default"})
     * @Gedmo\Versioned
     */
    protected $aminoAcidCount;

    /**
     * @var string $molecularWeight
     *
     * @ORM\Column(name="molecular_weight", type="decimal", precision=20, scale=3, nullable=true)
     * @Gedmo\Versioned
     * @JMS\Groups({"default"})
     * @JMS\Type("double")
     */
    protected $molecularWeight;

    /**
     * @var string $extinctionCoefficient
     *
     * @ORM\Column(name="extinction_coefficient", type="decimal", precision=20, scale=3, nullable=true)
     * @Gedmo\Versioned
     * @JMS\Groups({"default"})
     */
    protected $extinctionCoefficient;

    /**
     * @var string $purificationTags
     *
     * @ORM\Column(name="purification_tags", type="string", nullable=true, length=150)
     * @JMS\Groups({"default"})
     * @Gedmo\Versioned
     */
    protected $purificationTags;

    /**
     * @var string $species
     *
     * @ORM\Column(name="species", type="string", length=300, nullable=true)
     * @JMS\Groups({"default"})
     * @Gedmo\Versioned
     */
    protected $species;

    /**
     * @var string $cellLine
     *
     * @ORM\Column(name="cell_line", type="string", length=300, nullable=true)
     * @JMS\Groups({"default"})
     * @Gedmo\Versioned
     */
    protected $cellLine;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Storage\ProjectSample", mappedBy="sample")
     */
    protected $projectSamples;

    public $linkedSamples;

    public $projects;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    public function getArchivedAt()
    {
        return $this->archivedAt;
    }

    public function setArchivedAt($archivedAt)
    {
        $this->archivedAt = $archivedAt;
    }

    public function getStorageBuffer()
    {
        return $this->storageBuffer;
    }

    public function setStorageBuffer($storageBuffer)
    {
        $this->storageBuffer = $storageBuffer;
    }

    public function getProtocol()
    {
        return $this->protocol;
    }

    public function setProtocol(Protocol $protocol)
    {
        $this->protocol = $protocol;
    }

    public function getVectorName()
    {
        return $this->vectorName;
    }

    public function setVectorName($vectorName)
    {
        $this->vectorName = $vectorName;
    }


    public function getDnaSequence()
    {
        return $this->dnaSequence;
    }

    public function setDnaSequence($dnaSequence)
    {
        $this->dnaSequence = $dnaSequence;
    }

    public function getAminoAcidSequence()
    {
        return $this->aminoAcidSequence;
    }

    public function setAminoAcidSequence($aminoAcidSequence)
    {
        $this->aminoAcidSequence = $aminoAcidSequence;
    }

    public function getAminoAcidCount()
    {
        return $this->aminoAcidCount;
    }

    public function setAminoAcidCount($aminoAcidCount)
    {
        $this->aminoAcidCount = $aminoAcidCount;
    }

    public function getMolecularWeight()
    {
        return $this->molecularWeight;
    }

    public function setMolecularWeight($molecularWeight)
    {
        $this->molecularWeight = (string) $molecularWeight;
    }

    public function getExtinctionCoefficient()
    {
        return $this->extinctionCoefficient;
    }

    public function setExtinctionCoefficient($extinctionCoefficient)
    {
        $this->extinctionCoefficient = (string) $extinctionCoefficient;
    }

    public function getPurificationTags()
    {
        return $this->purificationTags;
    }

    public function setPurificationTags($purificationTags)
    {
        $this->purificationTags = $purificationTags;
    }

    public function getSpecies()
    {
        return $this->species;
    }

    public function setSpecies($species)
    {
        $this->species = $species;
    }

    public function getCellLine()
    {
        return $this->cellLine;
    }

    public function setCellLine($cellLine)
    {
        $this->cellLine = $cellLine;
    }

    /**
     * @JMS\VirtualProperty()
     * @JMS\Groups({"default"})
     */
    public function getStringLabel()
    {
        $catalog = $this->getCatalog();

        if (is_object($catalog)) {
            return $this->getCatalog()->getName();
        }

        return $this->getCatalog();
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
     * Gets the value of projectSamples.
     *
     * @return mixed
     */
    public function getProjectSamples()
    {
        return $this->projectSamples;
    }

    /**
     * Sets the value of projectSamples.
     *
     * @param mixed $projectSamples the project samples
     *
     * @return self
     */
    public function setProjectSamples($projectSamples)
    {
        $this->projectSamples = $projectSamples;

        return $this;
    }

    /**
     * Gets the value of linkedSamples.
     *
     * @return mixed
     */
    public function getLinkedSamples()
    {
        return $this->linkedSamples;
    }

    /**
     * Sets the value of linkedSamples.
     *
     * @param mixed $linkedSamples the linked samples
     *
     * @return self
     */
    public function setLinkedSamples($linkedSamples)
    {
        $this->linkedSamples = $linkedSamples;

        return $this;
    }

    /**
     * Gets the value of projects.
     *
     * @return mixed
     */
    public function getProjects()
    {
        return $this->projects;
    }

    /**
     * Sets the value of projects.
     *
     * @param mixed $projects the projects
     *
     * @return self
     */
    public function setProjects($projects)
    {
        $this->projects = $projects;

        return $this;
    }
}

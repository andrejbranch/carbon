<?php

namespace AppBundle\Entity\Storage;

use Carbon\ApiBundle\Annotation AS Carbon;
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
class Sample
{
    /**
     * Valid sample statuses
     *
     * @var array
     */
    private $validStatuses = array(
        'Available',
        'Depleted',
        'Destroyed',
        'Shipped'
    );

    /**
     * Valid concentration units
     *
     * @var array
     */
    private $validConcentrationUnits = array(
        'mg/mL',
        'ng/uL',
        'Molar',
    );

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
     * @Gedmo\Versioned
     * @JMS\Groups({"default"})
     * @Carbon\Searchable(name="name")
     * @Assert\NotBlank()
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     * @Gedmo\Versioned
     * @JMS\Groups({"default"})
     * @Carbon\Searchable(name="description")
     * @Assert\NotBlank()
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="notes", type="text", nullable=true)
     * @JMS\Groups({"default"})
     * @Carbon\Searchable(name="name")
     */
    private $notes;

    /**
     * @var User $createdBy
     *
     * @Gedmo\Blameable(on="create")
     * @ORM\ManyToOne(targetEntity="Carbon\ApiBundle\Entity\User")
     * @ORM\JoinColumn(name="created_by_id", referencedColumnName="id")
     * @JMS\Groups({"default"})
     */
    private $createdBy;

    /**
     * Created by id
     * @ORM\Column(name="created_by_id", type="integer", nullable=false)
     * @JMS\Groups({"default"})
     */
    private $createdById;

    /**
     * @var User $updatedBy
     *
     * @Gedmo\Blameable(on="update")
     * @ORM\ManyToOne(targetEntity="Carbon\ApiBundle\Entity\User")
     * @ORM\JoinColumn(name="updated_by_id", referencedColumnName="id")
     * @JMS\Groups({"default"})
     * @JMS\MaxDepth(1)
     */
    private $updatedBy;

    /**
     * Created by id
     * @ORM\Column(name="updated_by_id", type="integer", nullable=false)
     * @JMS\Groups({"default"})
     */
    private $updatedById;

    /**
     * @var integer
     *
     * @ORM\Column(name="division_id", type="integer", nullable=true)
     * @JMS\Groups({"default"})
     */
    private $divisionId;

    /**
     * @ORM\ManyToOne(targetEntity="Division", inversedBy="samples")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="division_id", referencedColumnName="id")
     * })
     * @JMS\Groups({"default"})
     * @Gedmo\Versioned
     */
    private $division;

    /**
     * @var string
     *
     * @ORM\Column(name="division_row", type="string", length=1, nullable=true)
     * @JMS\Groups({"default"})
     * @Gedmo\Versioned
     */
    private $divisionRow;

    /**
     * @var integer
     *
     * @ORM\Column(name="division_column", type="integer", length=1, nullable=true)
     * @JMS\Groups({"default"})
     * @Gedmo\Versioned
     */
    private $divisionColumn;

    /**
     * @var \DateTime $created
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     * @JMS\Groups({"default"})
     */
    private $createdAt;

    /**
     * @var \DateTime $updated
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime")
     * @JMS\Groups({"default"})
     */
    private $updatedAt;

    /**
     * @var \DateTime $deletedAt
     *
     * @ORM\Column(name="deleted_at", type="datetime", nullable=true)
     * @Gedmo\Versioned
     * @JMS\Groups({"default"})
     */
    private $deletedAt;

    /**
     * @var \DateTime $archivedAt
     *
     * @ORM\Column(name="archived_at", type="datetime", nullable=true)
     * @Gedmo\Versioned
     * @JMS\Groups({"default"})
     */
    private $archivedAt;

    /**
     * @var SampleType $sampleType
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Storage\SampleType")
     * @ORM\JoinColumn(name="sample_type_id", referencedColumnName="id")
     * @Gedmo\Versioned
     * @JMS\Groups({"default"})
     */
    private $sampleType;

    /**
     * Created by id
     * @ORM\Column(name="sample_type_id", type="integer", nullable=false)
     * @JMS\Groups({"default"})
     */
    private $sampleTypeId;

    /**
     * @var float $volume
     *
     * @ORM\Column(name="volume", type="decimal", precision=3, nullable=true)
     * @Gedmo\Versioned
     * @JMS\Groups({"default"})
     */
    private $volume;

    /**
     * @var StorageContainer $storageContainer
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Storage\StorageContainer")
     * @ORM\JoinColumn(name="storage_container_id", referencedColumnName="id", nullable=false)
     * @Gedmo\Versioned
     * @JMS\Groups({"default"})
     * @Assert\NotNull()
     */
    private $storageContainer;

    /**
     * @var string $storageBuffer
     *
     * @ORM\Column(name="storage_buffer", type="string", length=300, nullable=true)
     * @JMS\Groups({"default"})
     * @Gedmo\Versioned
     */
    private $storageBuffer;

    /**
     * @var string $status
     *
     * @ORM\Column(name="status", type="string", nullable=false)
     * @JMS\Groups({"default"})
     * @Gedmo\Versioned
     */
    private $status;

    /**
     * @var Protocol $protocol
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Storage\Protocol")
     * @ORM\JoinColumn(name="protocol_id", referencedColumnName="id")
     * @Gedmo\Versioned
     * @JMS\Groups({"default"})
     */
    private $protocol;

    /**
     * @var string $vectorName
     *
     * @ORM\Column(name="vector_name", type="string", nullable=true, length=150)
     * @JMS\Groups({"default"})
     * @Gedmo\Versioned
     */
    private $vectorName;

    /**
     * @var float $concentration
     *
     * @ORM\Column(name="concentration", type="decimal", precision=20, scale=3, nullable=true)
     * @Gedmo\Versioned
     * @JMS\Groups({"default"})
     * @JMS\Type("double")
     * @Gedmo\Versioned
     */
    private $concentration;

    /**
     * @var string $concentrationUnits
     *
     * @ORM\Column(name="concentration_units", type="string", nullable=true, length=15)
     * @JMS\Groups({"default"})
     * @Gedmo\Versioned
     */
    private $concentrationUnits;

    /**
     * @var string $dnaSequence
     *
     * @ORM\Column(name="dna_sequence", type="text", nullable=true)
     * @JMS\Groups({"default"})
     * @Gedmo\Versioned
     */
    private $dnaSequence;

    /**
     * @var string $aminoAcidSequence
     *
     * @ORM\Column(name="amino_acid_sequence", type="text", nullable=true)
     * @JMS\Groups({"default"})
     * @Gedmo\Versioned
     */
    private $aminoAcidSequence;

    /**
     * @var string $aminoAcidCount
     *
     * @ORM\Column(name="amino_acid_count", type="integer", nullable=true)
     * @JMS\Groups({"default"})
     * @Gedmo\Versioned
     */
    private $aminoAcidCount;

    /**
     * @var string $molecularWeight
     *
     * @ORM\Column(name="molecular_weight", type="decimal", precision=20, scale=3, nullable=true)
     * @Gedmo\Versioned
     * @JMS\Groups({"default"})
     * @JMS\Type("double")
     */
    private $molecularWeight;

    /**
     * @var string $extinctionCoefficient
     *
     * @ORM\Column(name="extinction_coefficient", type="decimal", precision=20, scale=3, nullable=true)
     * @Gedmo\Versioned
     * @JMS\Groups({"default"})
     */
    private $extinctionCoefficient;

    /**
     * @var string $purificationTags
     *
     * @ORM\Column(name="purification_tags", type="string", nullable=true, length=150)
     * @JMS\Groups({"default"})
     * @Gedmo\Versioned
     */
    private $purificationTags;

    /**
     * @var string $species
     *
     * @ORM\Column(name="species", type="string", length=300, nullable=true)
     * @JMS\Groups({"default"})
     * @Gedmo\Versioned
     */
    private $species;

    /**
     * @var string $cellLine
     *
     * @ORM\Column(name="cell_line", type="string", length=300, nullable=true)
     * @JMS\Groups({"default"})
     * @Gedmo\Versioned
     */
    private $cellLine;

    /**
     * @var float $mass
     *
     * @ORM\Column(name="mass", type="decimal", precision=20, scale=3, nullable=true)
     * @Gedmo\Versioned
     * @JMS\Groups({"default"})
     * @JMS\Type("double")
     */
    private $mass;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Storage\ProjectSample", mappedBy="sample")
     */
    protected $projectSamples;

    public $linkedSamples;

    public $projects;

    public $attachments;

    /**
     * @JMS\Groups({"default"})
     */
    public $storageRecommended;

    /**
     * @JMS\Groups({"default"})
     */
    public $recommendedDivision;

    /**
     * @JMS\Groups({"default"})
     */
    public $recommendedDivisionRow;

    /**
     * @JMS\Groups({"default"})
     */
    public $recommendedDivisionColumn;

    /**
     * @JMS\Groups({"default"})
     */
    public $errors;

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
     * Get created by id
     *
     * @return integer
     */
    public function getCreatedById()
    {
        return $this->createdById;
    }

    /**
     * Get created by user
     *
     * @return Carbon\ApiBundle\User
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * Get updated by user
     *
     * @return Carbon\ApiBundle\User
     */
    public function getUpdatedBy()
    {
        return $this->updateBy;
    }

    /**
     * Get updated by id
     *
     * @return integer
     */
    public function getUpdatedById()
    {
        return $this->updatedById;
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

    public function getDeletedAt()
    {
        return $this->deletedAt;
    }

    public function setDeletedAt($deletedAt)
    {
        $this->deletedAt = $deletedAt;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    public function getArchivedAt()
    {
        return $this->archivedAt;
    }

    public function setArchivedAt($archivedAt)
    {
        $this->archivedAt = $archivedAt;
    }

    public function getSampleType()
    {
        return $this->sampleType;
    }

    public function getSampleTypeId()
    {
        return $this->sampleTypeId;
    }

    public function setSampleTypeId($sampleTypeId)
    {
        $this->sampleTypeId = $sampleTypeId;
    }

    public function setSampleType(SampleType $sampleType = null)
    {
        $this->sampleType = $sampleType;
    }

    public function getVolume()
    {
        return $this->volume;
    }

    public function setVolume($volume)
    {
        $this->volume = (string) $volume;
    }

    public function getStorageContainer()
    {
        return $this->storageContainer;
    }

    public function setStorageContainer(StorageContainer $storageContainer = null)
    {
        $this->storageContainer = $storageContainer;
    }

    public function getStorageBuffer()
    {
        return $this->storageBuffer;
    }

    public function setStorageBuffer($storageBuffer)
    {
        $this->storageBuffer = $storageBuffer;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
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

    public function getConcentration()
    {
        return $this->concentration;
    }

    public function setConcentration($concentration)
    {
        $this->concentration = (string) $concentration;
    }

    public function getConcentrationUnits()
    {
        return $this->concentrationUnits;
    }

    public function setConcentrationUnits($concentrationUnits)
    {
        $this->concentrationUnits = $concentrationUnits;
    }

    /**
     * @JMS\VirtualProperty()
     * @JMS\Groups({"default"})
     */
    public function getConcentrationString()
    {
        return $this->concentration
            ? $this->concentration . ' ' . $this->concentrationUnits
            : ''
        ;
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

    public function getMass()
    {
        return $this->mass;
    }

    public function setMass($mass)
    {
        $this->mass = (string) $mass;
    }

    /**
     * @JMS\VirtualProperty()
     * @JMS\Groups({"default"})
     */
    public function getStringLabel()
    {
        return $this->getName();
    }

    /**
     * Gets the Valid sample statuses.
     *
     * @return array
     */
    public function getValidStatuses()
    {
        return $this->validStatuses;
    }

    /**
     * Sets the Valid sample statuses.
     *
     * @param array $validStatuses the valid statuses
     *
     * @return self
     */
    public function setValidStatuses(array $validStatuses)
    {
        $this->validStatuses = $validStatuses;

        return $this;
    }

    /**
     * Gets the Valid concentration units.
     *
     * @return array
     */
    public function getValidConcentrationUnits()
    {
        return $this->validConcentrationUnits;
    }

    /**
     * Sets the Valid concentration units.
     *
     * @param array $validConcentrationUnits the valid concentration units
     *
     * @return self
     */
    public function setValidConcentrationUnits(array $validConcentrationUnits)
    {
        $this->validConcentrationUnits = $validConcentrationUnits;

        return $this;
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
     * Sets the value of notes.
     *
     * @param string $notes the notes
     *
     * @return self
     */
    public function setNotes($notes)
    {
        $this->notes = $notes;

        return $this;
    }

    /**
     * Sets the value of createdBy.
     *
     * @param User $createdBy $createdBy the created by
     *
     * @return self
     */
    public function setCreatedBy($createdBy)
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    /**
     * Sets the Created by id.
     *
     * @param mixed $createdById the created by id
     *
     * @return self
     */
    public function setCreatedById($createdById)
    {
        $this->createdById = $createdById;

        return $this;
    }

    /**
     * Sets the value of updatedBy.
     *
     * @param User $updatedBy $updatedBy the updated by
     *
     * @return self
     */
    public function setUpdatedBy($updatedBy)
    {
        $this->updatedBy = $updatedBy;

        return $this;
    }

    /**
     * Sets the Created by id.
     *
     * @param mixed $updatedById the updated by id
     *
     * @return self
     */
    public function setUpdatedById($updatedById)
    {
        $this->updatedById = $updatedById;

        return $this;
    }

    /**
     * Sets the value of createdAt.
     *
     * @param \DateTime $created $createdAt the created at
     *
     * @return self
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Sets the value of updatedAt.
     *
     * @param \DateTime $updated $updatedAt the updated at
     *
     * @return self
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

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

    /**
     * Gets the value of storageRecommended.
     *
     * @return mixed
     */
    public function getStorageRecommended()
    {
        return $this->storageRecommended;
    }

    /**
     * Sets the value of storageRecommended.
     *
     * @param mixed $storageRecommended the storage recommended
     *
     * @return self
     */
    public function setStorageRecommended($storageRecommended)
    {
        $this->storageRecommended = $storageRecommended;

        return $this;
    }

    /**
     * Gets the value of recommendedDivision.
     *
     * @return mixed
     */
    public function getRecommendedDivision()
    {
        return $this->recommendedDivision;
    }

    /**
     * Sets the value of recommendedDivision.
     *
     * @param mixed $recommendedDivision the recommended division
     *
     * @return self
     */
    public function setRecommendedDivision($recommendedDivision)
    {
        $this->recommendedDivision = $recommendedDivision;

        return $this;
    }

    /**
     * Gets the value of recommendedDivisionRow.
     *
     * @return mixed
     */
    public function getRecommendedDivisionRow()
    {
        return $this->recommendedDivisionRow;
    }

    /**
     * Sets the value of recommendedDivisionRow.
     *
     * @param mixed $recommendedDivisionRow the recommended division row
     *
     * @return self
     */
    public function setRecommendedDivisionRow($recommendedDivisionRow)
    {
        $this->recommendedDivisionRow = $recommendedDivisionRow;

        return $this;
    }

    /**
     * Gets the value of recommendedDivisionColumn.
     *
     * @return mixed
     */
    public function getRecommendedDivisionColumn()
    {
        return $this->recommendedDivisionColumn;
    }

    /**
     * Sets the value of recommendedDivisionColumn.
     *
     * @param mixed $recommendedDivisionColumn the recommended division column
     *
     * @return self
     */
    public function setRecommendedDivisionColumn($recommendedDivisionColumn)
    {
        $this->recommendedDivisionColumn = $recommendedDivisionColumn;

        return $this;
    }

    /**
     * Gets the value of errors.
     *
     * @return mixed
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * Sets the value of errors.
     *
     * @param mixed $errors the errors
     *
     * @return self
     */
    public function setErrors($errors)
    {
        $this->errors = $errors;

        return $this;
    }
}

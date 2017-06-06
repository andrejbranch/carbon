<?php

namespace AppBundle\Entity\Storage;

use Carbon\ApiBundle\Annotation AS Carbon;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use JMS\Serializer\Annotation AS JMS;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Storage\DivisionRepository")
 * @ORM\Table(name="storage.division", schema="storage")
 * @Gedmo\Tree(type="nested")
 * @Gedmo\Loggable
 */
class Division
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @JMS\Groups({"default"})
     */
    protected $id;

    /**
     * @ORM\Column(name="has_dimension", type="boolean")
     * @JMS\Groups({"default"})
     */
    protected $hasDimension = false;

    /**
     * @ORM\Column(name="height", type="integer", length=2, nullable=true)
     * @JMS\Groups({"default"})
     * @Assert\Range(min=1, max=20)
     */
    protected $height;

    /**
     * @ORM\Column(name="width", type="integer", length=2, nullable=true)
     * @JMS\Groups({"default"})
     * @Assert\Range(min=1, max=20)
     */
    protected $width;

    /**
     * @Gedmo\TreeLeft
     * @JMS\Groups({"default"})
     * @ORM\Column(name="lft", type="integer")
     */
    private $lft;

    /**
     * @Gedmo\TreeRight
     * @JMS\Groups({"default"})
     * @ORM\Column(name="rgt", type="integer")
     */
    private $rgt;

    /**
     * @ORM\Column(name="availableSlots", type="integer", length=3, nullable=false)
     * @JMS\Groups({"default"})
     */
    protected $availableSlots = 0;

    /**
     * @ORM\Column(name="usedSlots", type="integer", length=3, nullable=false)
     * @JMS\Groups({"default"})
     */
    protected $usedSlots = 0;

    /**
     * @ORM\Column(name="totalSlots", type="integer", length=3, nullable=false)
     * @JMS\Groups({"default"})
     */
    protected $totalSlots = 0;

    /**
     * @ORM\Column(name="percentFull", type="decimal", precision=20, scale=3, nullable=false)
     * @JMS\Groups({"default"})
     */
    protected $percentFull = 0;

    /**
     * @ORM\Column(name="path", type="string", length=3000, nullable=true)
     * @JMS\Groups({"default"})
     */
    protected $path;

    /**
     * @ORM\Column(name="id_path", type="string", length=3000, nullable=true)
     * @JMS\Groups({"default"})
     */
    protected $idPath;

    /**
     * @Gedmo\TreePathSource
     * @ORM\Column(name="title", type="string", length=64)
     * @JMS\Groups({"default"})
     * @Assert\NotBlank()
     * @Carbon\Searchable(name="title")
     */
    protected $title;

    /**
     * @ORM\Column(name="description", type="string", length=300)
     * @JMS\Groups({"default"})
     * @Carbon\Searchable(name="description")
     */
    protected $description;

    /**
     * @ORM\Column(name="parent_id", type="integer", nullable=true)
     * @JMS\Groups({"default"})
     */
    protected $parentId;

    /**
     * @Gedmo\TreeParent
     * @ORM\ManyToOne(targetEntity="Division", inversedBy="children")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="parent_id", referencedColumnName="id", onDelete="CASCADE")
     * })
     * @JMS\Groups({"parent"})
     */
    protected $parent;

    /**
     * @Gedmo\TreeLevel
     * @ORM\Column(name="level", type="integer", nullable=true)
     * @JMS\Groups({"default"})
     */
    protected $level;

    /**
     * @ORM\OneToMany(targetEntity="Division", mappedBy="parent")
     */
    protected $children;

    /**
     * @ORM\Column(name="is_public_edit", type="boolean", nullable=false)
     * @JMS\Groups({"default"})
     */
    protected $isPublicEdit = false;

    /**
     * @ORM\Column(name="is_public_view", type="boolean", nullable=false)
     * @JMS\Groups({"default"})
     */
    protected $isPublicView = true;

    /**
     * @ORM\OneToMany(targetEntity="Sample", mappedBy="division")
     * @JMS\Groups({"samples"})
     */
    protected $samples;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Storage\DivisionSampleType", mappedBy="division")
     */
    protected $divisionSampleTypes;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Storage\DivisionStorageContainer", mappedBy="division")
     */
    protected $divisionStorageContainers;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Storage\DivisionGroupEditor", mappedBy="division")
     */
    protected $divisionGroupEditors;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Storage\DivisionEditor", mappedBy="division")
     */
    protected $divisionEditors;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Storage\DivisionViewer", mappedBy="division")
     */
    protected $divisionViewers;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Storage\DivisionGroupViewer", mappedBy="division")
     */
    protected $divisionGroupViewers;

    public $sampleTypes;

    public $storageContainers;

    public $editors;

    public $groupEditors;

    public $viewers;

    public $groupViewers;

    public function __construct()
    {
        $this->divisionSampleTypes = new ArrayCollection();
        $this->divisionStorageContainers = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getHasDimension()
    {
        return $this->hasDimension;
    }

    public function setHasDimension($hasDimension)
    {
        $this->hasDimension = (bool) $hasDimension;
    }

    public function getWidth()
    {
        return $this->width;
    }

    public function setWidth($width)
    {
        $this->width = (int) $width;
    }

    public function getHeight()
    {
        return $this->height;
    }

    public function setHeight($height)
    {
        $this->height = (int) $height;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setParent(Division $parent = null)
    {
        $this->parent = $parent;
    }

    public function getParentId()
    {
        return $this->parentId;
    }

    public function getParent()
    {
        return $this->parent;
    }

    public function setPath($path)
    {
        $this->path = $path;
    }

    public function getPath()
    {
        return $this->path;
    }

    public function getLevel()
    {
        return $this->level;
    }

    public function getSort()
    {
        return $this->sort;
    }

    public function addDivisionSampleType(DivisionSampleType $divisionSampleType)
    {
        $this->divisionSampleTypes->add($divisionSampleType);
    }

    public function removeSampleType(DivisionSampleType $divisionSampleType)
    {
        $this->divisionSampleTypes->removeElement($divisionSampleType);
    }

    public function addDivisionStorageContainer(DivisionStorageContainer $divisionStorageContainer)
    {
        $this->divisionStorageContainer->add($divisionStorageContainer);
    }

    public function removeDivisionStorageContainer(DivisionStorageContainer $divisionStorageContainer)
    {
        $this->divisionStorageContainer->removeElement($divisionStorageContainer);
    }

    public function getSampleTypes()
    {
        return $this->sampleTypes;
    }

    public function getAvailableSlots()
    {
        return $this->availableSlots;
    }

    public function setAvailableSlots($availableSlots)
    {
        $this->availableSlots = $availableSlots;
    }

    public function getUsedSlots()
    {
        return $this->usedSlots;
    }

    public function setUsedSlots($usedSlots)
    {
        $this->usedSlots = $usedSlots;
    }

    public function getTotalSlots()
    {
        return $this->totalSlots;
    }

    public function setTotalSlots($totalSlots)
    {
        $this->totalSlots = $totalSlots;
    }

    public function getPercentFull()
    {
        return $this->percentFull;
    }

    public function setPercentFull($percentFull)
    {
        $this->percentFull = $percentFull;
    }

    public function getSamples()
    {
        return $this->samples;
    }

    public function hasDimension()
    {
        return $this->hasDimension;
    }

    public function setChildren($children)
    {
        $this->children = $children;
    }

    /**
     * @JMS\VirtualProperty()
     * @JMS\Groups({"default"})
     */
    public function getPercentFullString()
    {
        if (!$this->hasDimension()) {
            return 'N/A';
        }

        return $this->percentFull . '%';
    }

    /**
     * @JMS\VirtualProperty()
     * @JMS\Groups({"default"})
     */
    public function getDimensionString()
    {
        if (!$this->hasDimension()) {
            return 'N/A';
        }

        return $this->getHeight() . ' x ' . $this->getWidth();
    }

    /**
     * @JMS\VirtualProperty()
     * @JMS\Groups({"default"})
     */
    public function getStringLabel()
    {
        return $this->getPath();
    }

    /**
     * Sets the value of id.
     *
     * @param mixed $id the id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Gets the value of lft.
     *
     * @return mixed
     */
    public function getLft()
    {
        return $this->lft;
    }

    /**
     * Sets the value of lft.
     *
     * @param mixed $lft the lft
     *
     * @return self
     */
    public function setLft($lft)
    {
        $this->lft = $lft;

        return $this;
    }

    /**
     * Gets the value of rgt.
     *
     * @return mixed
     */
    public function getRgt()
    {
        return $this->rgt;
    }

    /**
     * Sets the value of rgt.
     *
     * @param mixed $rgt the rgt
     *
     * @return self
     */
    public function setRgt($rgt)
    {
        $this->rgt = $rgt;

        return $this;
    }

    /**
     * Sets the value of parentId.
     *
     * @param mixed $parentId the parent id
     *
     * @return self
     */
    public function setParentId($parentId)
    {
        $this->parentId = $parentId;

        return $this;
    }

    /**
     * Sets the value of level.
     *
     * @param mixed $level the level
     *
     * @return self
     */
    public function setLevel($level)
    {
        $this->level = $level;

        return $this;
    }

    /**
     * Gets the value of children.
     *
     * @return mixed
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * Sets the value of samples.
     *
     * @param mixed $samples the samples
     *
     * @return self
     */
    public function setSamples($samples)
    {
        $this->samples = $samples;

        return $this;
    }

    /**
     * Gets the value of divisionSampleTypes.
     *
     * @return mixed
     */
    public function getDivisionSampleTypes()
    {
        return $this->divisionSampleTypes;
    }

    /**
     * Sets the value of divisionSampleTypes.
     *
     * @param mixed $divisionSampleTypes the division sample types
     *
     * @return self
     */
    public function setDivisionSampleTypes($divisionSampleTypes)
    {
        $this->divisionSampleTypes = $divisionSampleTypes;

        return $this;
    }

    /**
     * Gets the value of divisionStorageContainers.
     *
     * @return mixed
     */
    public function getDivisionStorageContainers()
    {
        return $this->divisionStorageContainers;
    }

    /**
     * Sets the value of divisionStorageContainers.
     *
     * @param mixed $divisionStorageContainers the division storage containers
     *
     * @return self
     */
    public function setDivisionStorageContainers($divisionStorageContainers)
    {
        $this->divisionStorageContainers = $divisionStorageContainers;

        return $this;
    }

    /**
     * Sets the value of sampleTypes.
     *
     * @param mixed $sampleTypes the sample types
     *
     * @return self
     */
    public function setSampleTypes($sampleTypes)
    {
        $this->sampleTypes = $sampleTypes;

        return $this;
    }

    /**
     * Gets the value of storageContainers.
     *
     * @return mixed
     */
    public function getStorageContainers()
    {
        return $this->storageContainers;
    }

    /**
     * Sets the value of storageContainers.
     *
     * @param mixed $storageContainers the storage containers
     *
     * @return self
     */
    public function setStorageContainers($storageContainers)
    {
        $this->storageContainers = $storageContainers;

        return $this;
    }

    /**
     * Gets the value of description.
     *
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Sets the value of description.
     *
     * @param mixed $description the description
     *
     * @return self
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Gets the value of divisionEditors.
     *
     * @return mixed
     */
    public function getDivisionEditors()
    {
        return $this->divisionEditors;
    }

    /**
     * Sets the value of divisionEditors.
     *
     * @param mixed $divisionEditors the division editors
     *
     * @return self
     */
    public function setDivisionEditors($divisionEditors)
    {
        $this->divisionEditors = $divisionEditors;

        return $this;
    }

    /**
     * Gets the value of editors.
     *
     * @return mixed
     */
    public function getEditors()
    {
        return $this->editors;
    }

    /**
     * Sets the value of editors.
     *
     * @param mixed $editors the editors
     *
     * @return self
     */
    public function setEditors($editors)
    {
        $this->editors = $editors;

        return $this;
    }

    /**
     * Gets the value of idPath.
     *
     * @return mixed
     */
    public function getIdPath()
    {
        return $this->idPath;
    }

    /**
     * Sets the value of idPath.
     *
     * @param mixed $idPath the id path
     *
     * @return self
     */
    public function setIdPath($idPath)
    {
        $this->idPath = $idPath;

        return $this;
    }

    /**
     * Gets the value of divisionViewers.
     *
     * @return mixed
     */
    public function getDivisionViewers()
    {
        return $this->divisionViewers;
    }

    /**
     * Sets the value of divisionViewers.
     *
     * @param mixed $divisionViewers the division viewers
     *
     * @return self
     */
    public function setDivisionViewers($divisionViewers)
    {
        $this->divisionViewers = $divisionViewers;

        return $this;
    }

    /**
     * Gets the value of viewers.
     *
     * @return mixed
     */
    public function getViewers()
    {
        return $this->viewers;
    }

    /**
     * Sets the value of viewers.
     *
     * @param mixed $viewers the viewers
     *
     * @return self
     */
    public function setViewers($viewers)
    {
        $this->viewers = $viewers;

        return $this;
    }

    /**
     * Gets the value of divisionGroupEditors.
     *
     * @return mixed
     */
    public function getDivisionGroupEditors()
    {
        return $this->divisionGroupEditors;
    }

    /**
     * Sets the value of divisionGroupEditors.
     *
     * @param mixed $divisionGroupEditors the division group editors
     *
     * @return self
     */
    public function setDivisionGroupEditors($divisionGroupEditors)
    {
        $this->divisionGroupEditors = $divisionGroupEditors;

        return $this;
    }

    /**
     * Gets the value of divisionGroupViewers.
     *
     * @return mixed
     */
    public function getDivisionGroupViewers()
    {
        return $this->divisionGroupViewers;
    }

    /**
     * Sets the value of divisionGroupViewers.
     *
     * @param mixed $divisionGroupViewers the division group viewers
     *
     * @return self
     */
    public function setDivisionGroupViewers($divisionGroupViewers)
    {
        $this->divisionGroupViewers = $divisionGroupViewers;

        return $this;
    }

    /**
     * Gets the value of groupEditors.
     *
     * @return mixed
     */
    public function getGroupEditors()
    {
        return $this->groupEditors;
    }

    /**
     * Sets the value of groupEditors.
     *
     * @param mixed $groupEditors the group editors
     *
     * @return self
     */
    public function setGroupEditors($groupEditors)
    {
        $this->groupEditors = $groupEditors;

        return $this;
    }

    /**
     * Gets the value of groupViewers.
     *
     * @return mixed
     */
    public function getGroupViewers()
    {
        return $this->groupViewers;
    }

    /**
     * Sets the value of groupViewers.
     *
     * @param mixed $groupViewers the group viewers
     *
     * @return self
     */
    public function setGroupViewers($groupViewers)
    {
        $this->groupViewers = $groupViewers;

        return $this;
    }

    /**
     * Gets the value of isPublicEdit.
     *
     * @return mixed
     */
    public function getIsPublicEdit()
    {
        return $this->isPublicEdit;
    }

    /**
     * Sets the value of isPublicEdit.
     *
     * @param mixed $isPublicEdit the is public edit
     *
     * @return self
     */
    public function setIsPublicEdit($isPublicEdit)
    {
        $this->isPublicEdit = $isPublicEdit;

        return $this;
    }

    /**
     * Gets the value of isPublicView.
     *
     * @return mixed
     */
    public function getIsPublicView()
    {
        return $this->isPublicView;
    }

    /**
     * Sets the value of isPublicView.
     *
     * @param mixed $isPublicView the is public view
     *
     * @return self
     */
    public function setIsPublicView($isPublicView)
    {
        $this->isPublicView = $isPublicView;

        return $this;
    }
}

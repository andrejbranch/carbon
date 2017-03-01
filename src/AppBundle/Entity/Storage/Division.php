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
 * @Gedmo\Tree(type="materializedPath")
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
     * @Gedmo\TreePath
     * @ORM\Column(name="path", type="string", length=3000, nullable=true)
     * @JMS\Groups({"default"})
     */
    protected $path;

    /**
     * @Gedmo\TreePathSource
     * @ORM\Column(name="title", type="string", length=64)
     * @JMS\Groups({"default"})
     * @Assert\NotBlank()
     * @Carbon\Searchable(name="title")
     */
    protected $title;

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
     * @JMS\Groups({"children"})
     * @JMS\MaxDepth(2)
     */
    protected $children;

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

    public $sampleTypes;

    public $storageContainers;

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
        return $this->getTitle();
    }
}

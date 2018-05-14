<?php

namespace AppBundle\Entity;

use Carbon\ApiBundle\Annotation AS Carbon;
use Carbon\ApiBundle\Entity\BaseCryoblockEntity;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation AS JMS;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Project
 *
 * @ORM\Entity()
 * @ORM\Table(name="project")
 * @Gedmo\Loggable
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false)
 */
class Project extends BaseCryoblockEntity
{
    /**
     * Valid project statuses
     *
     * @var array
     */
    protected $validStatuses = array(
        'Ongoing',
        'Completed',
    );

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @JMS\Groups({"default"})
     */
    protected $id;

    /**
     * @var string
     *
     * @Carbon\Searchable("name")
     * @ORM\Column(name="name", type="string", length=300)
     * @JMS\Groups({"default"})
     * @Gedmo\Versioned
     */
    protected $name;

    /**
     * @var string
     *
     * @Carbon\Searchable("name")
     * @ORM\Column(name="description", type="text")
     * @JMS\Groups({"default"})
     * @Gedmo\Versioned
     */
    protected $description;

    /**
     * @var string
     *
     * @Carbon\Searchable("name")
     * @ORM\Column(name="status", type="string", length=255)
     * @JMS\Groups({"default"})
     * @Gedmo\Versioned
     */
    protected $status;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Storage\ProjectSample", mappedBy="project")
     */
    protected $projectSamples;

    public $samples;

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
     * Set status
     *
     * @param string $status
     *
     * @return Project
     */
    public function setStatus($status)
    {
        if (!in_array($status, $this->validStatuses)) {
            throw new \InvalidArgumentException(sprintf('%s is not a valid status', $status));
        }

        $this->status = $status;
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
     * @JMS\VirtualProperty()
     * @JMS\Groups({"default"})
     */
    public function getStringLabel()
    {
        return $this->getName();
    }
}

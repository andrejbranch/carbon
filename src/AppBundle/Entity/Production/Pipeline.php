<?php

namespace AppBundle\Entity\Production;

use Carbon\ApiBundle\Annotation AS Carbon;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use JMS\Serializer\Annotation AS JMS;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity()
 * @ORM\Table(name="production.pipeline", schema="production")
 * @Gedmo\Loggable
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false)
 */
class Pipeline
{
    const STATUS_PENDING_PIPELINE = 'Pending-Pipeline';

    /**
     * Valid statuses
     *
     * @var array
     */
    private $validStatuses = array(
        'Pending',
        'Pending-Pipeline',
        'Processing',
        'Aborted',
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
    private $id;

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

    /* transient */
    public $steps;

    /**
     * Gets the Valid statuses.
     *
     * @return array
     */
    public function getValidStatuses()
    {
        return $this->validStatuses;
    }

    /**
     * Sets the Valid statuses.
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
     * Gets the value of createdBy.
     *
     * @return User $createdBy
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
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
     * Gets the Created by id.
     *
     * @return mixed
     */
    public function getCreatedById()
    {
        return $this->createdById;
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
     * Gets the value of updatedBy.
     *
     * @return User $updatedBy
     */
    public function getUpdatedBy()
    {
        return $this->updatedBy;
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
     * Gets the Created by id.
     *
     * @return mixed
     */
    public function getUpdatedById()
    {
        return $this->updatedById;
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
     * Gets the value of createdAt.
     *
     * @return \DateTime $created
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
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
     * Gets the value of updatedAt.
     *
     * @return \DateTime $updated
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
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
     * Gets the value of deletedAt.
     *
     * @return \DateTime $deletedAt
     */
    public function getDeletedAt()
    {
        return $this->deletedAt;
    }

    /**
     * Sets the value of deletedAt.
     *
     * @param \DateTime $deletedAt $deletedAt the deleted at
     *
     * @return self
     */
    public function setDeletedAt($deletedAt)
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }
}

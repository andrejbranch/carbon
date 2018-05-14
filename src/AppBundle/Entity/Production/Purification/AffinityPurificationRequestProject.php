<?php

namespace AppBundle\Entity\Production\Purification;

use AppBundle\Entity\Storage\Sample;
use Carbon\ApiBundle\Annotation AS Carbon;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use JMS\Serializer\Annotation AS JMS;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity()
 * @ORM\Table(name="production.affinity_purification_request_project", schema="production")
 */
class AffinityPurificationRequestProject
{
    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @JMS\Groups({"default"})
     */
    protected $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="purification_request_id", type="integer")
     * @JMS\Groups({"default"})
     */
    protected $purificationRequestId;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Production\Purification\AffinityPurificationRequest")
     * @ORM\JoinColumn(name="purification_request_id", nullable=false)
     * @JMS\Groups({"default"})
     */
    protected $purificationRequest;

    /**
     * @var integer
     *
     * @ORM\Column(name="project_id", type="integer")
     * @JMS\Groups({"default"})
     */
    protected $projectId;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Project")
     * @ORM\JoinColumn(name="project_id", nullable=false)
     * @JMS\Groups({"default"})
     */
    protected $project;

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
     * Gets the value of purificationRequestId.
     *
     * @return integer
     */
    public function getPurificationRequestId()
    {
        return $this->purificationRequestId;
    }

    /**
     * Sets the value of purificationRequestId.
     *
     * @param integer $purificationRequestId the purification request id
     *
     * @return self
     */
    public function setPurificationRequestId($purificationRequestId)
    {
        $this->purificationRequestId = $purificationRequestId;

        return $this;
    }

    /**
     * Gets the value of purificationRequest.
     *
     * @return mixed
     */
    public function getPurificationRequest()
    {
        return $this->purificationRequest;
    }

    /**
     * Sets the value of purificationRequest.
     *
     * @param mixed $purificationRequest the purification request
     *
     * @return self
     */
    public function setPurificationRequest($purificationRequest)
    {
        $this->purificationRequest = $purificationRequest;

        return $this;
    }

    /**
     * Gets the value of projectId.
     *
     * @return integer
     */
    public function getProjectId()
    {
        return $this->projectId;
    }

    /**
     * Sets the value of projectId.
     *
     * @param integer $projectId the project id
     *
     * @return self
     */
    public function setProjectId($projectId)
    {
        $this->projectId = $projectId;

        return $this;
    }

    /**
     * Gets the value of project.
     *
     * @return mixed
     */
    public function getProject()
    {
        return $this->project;
    }

    /**
     * Sets the value of project.
     *
     * @param mixed $project the project
     *
     * @return self
     */
    public function setProject($project)
    {
        $this->project = $project;

        return $this;
    }
}

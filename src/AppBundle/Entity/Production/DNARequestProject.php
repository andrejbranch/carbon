<?php

namespace AppBundle\Entity\Production;

use AppBundle\Entity\Storage\Sample;
use Carbon\ApiBundle\Annotation AS Carbon;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use JMS\Serializer\Annotation AS JMS;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Division Sample Type
 *
 * @ORM\Entity()
 * @ORM\Table(name="production.dna_request_project", schema="production")
 */
class DNARequestProject
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
     * @ORM\Column(name="dna_request_id", type="integer")
     * @JMS\Groups({"default"})
     */
    private $dnaRequestId;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Production\DNA")
     * @ORM\JoinColumn(name="dna_request_id", nullable=false)
     * @JMS\Groups({"default"})
     */
    private $dnaRequest;

    /**
     * @var integer
     *
     * @ORM\Column(name="project_id", type="integer")
     * @JMS\Groups({"default"})
     */
    private $projectId;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Project", inversedBy="dnaRequestProjects")
     * @ORM\JoinColumn(name="project_id", nullable=false)
     * @JMS\Groups({"default"})
     */
    private $project;

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
     * Gets the value of dnaRequestId.
     *
     * @return integer
     */
    public function getDnaRequestId()
    {
        return $this->dnaRequestId;
    }

    /**
     * Sets the value of dnaRequestId.
     *
     * @param integer $dnaRequestId the dna request id
     *
     * @return self
     */
    public function setDnaRequestId($dnaRequestId)
    {
        $this->dnaRequestId = $dnaRequestId;

        return $this;
    }

    /**
     * Gets the value of dnaRequest.
     *
     * @return mixed
     */
    public function getDnaRequest()
    {
        return $this->dnaRequest;
    }

    /**
     * Sets the value of dnaRequest.
     *
     * @param mixed $dnaRequest the dna request
     *
     * @return self
     */
    public function setDnaRequest($dnaRequest)
    {
        $this->dnaRequest = $dnaRequest;

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

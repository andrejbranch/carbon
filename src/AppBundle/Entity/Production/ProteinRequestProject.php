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
 * @ORM\Entity()
 * @ORM\Table(name="production.protein_request_project", schema="production")
 */
class ProteinRequestProject
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
     * @ORM\Column(name="protein_request_id", type="integer")
     * @JMS\Groups({"default"})
     */
    private $proteinRequestId;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Production\ProteinRequest")
     * @ORM\JoinColumn(name="protein_request_id", nullable=false)
     * @JMS\Groups({"default"})
     */
    private $proteinRequest;

    /**
     * @var integer
     *
     * @ORM\Column(name="project_id", type="integer")
     * @JMS\Groups({"default"})
     */
    private $projectId;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Project", inversedBy="proteinRequestProjects")
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
     * Gets the value of proteinRequestId.
     *
     * @return integer
     */
    public function getProteinRequestId()
    {
        return $this->proteinRequestId;
    }

    /**
     * Sets the value of proteinRequestId.
     *
     * @param integer $proteinRequestId the protein request id
     *
     * @return self
     */
    public function setProteinRequestId($proteinRequestId)
    {
        $this->proteinRequestId = $proteinRequestId;

        return $this;
    }

    /**
     * Gets the value of proteinRequest.
     *
     * @return mixed
     */
    public function getProteinRequest()
    {
        return $this->proteinRequest;
    }

    /**
     * Sets the value of proteinRequest.
     *
     * @param mixed $proteinRequest the protein request
     *
     * @return self
     */
    public function setProteinRequest($proteinRequest)
    {
        $this->proteinRequest = $proteinRequest;

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

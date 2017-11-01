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
 * @ORM\Table(name="production.analysis_request_project", schema="production")
 */
class AnalysisRequestProject
{
    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @JMS\Groups({"default"})
     */
    protected $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="analysis_request_id", type="integer")
     * @JMS\Groups({"default"})
     */
    protected $analysisRequestId;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Production\AnalysisRequest")
     * @ORM\JoinColumn(name="analysis_request_id", nullable=false)
     * @JMS\Groups({"default"})
     */
    protected $analysisRequest;

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
     * Gets the value of analysisRequestId.
     *
     * @return integer
     */
    public function getAnalysisRequestId()
    {
        return $this->analysisRequestId;
    }

    /**
     * Sets the value of analysisRequestId.
     *
     * @param integer $analysisRequestId the analysis request id
     *
     * @return self
     */
    public function setAnalysisRequestId($analysisRequestId)
    {
        $this->analysisRequestId = $analysisRequestId;

        return $this;
    }

    /**
     * Gets the value of analysisRequest.
     *
     * @return mixed
     */
    public function getAnalysisRequest()
    {
        return $this->analysisRequest;
    }

    /**
     * Sets the value of analysisRequest.
     *
     * @param mixed $analysisRequest the analysis request
     *
     * @return self
     */
    public function setAnalysisRequest($analysisRequest)
    {
        $this->analysisRequest = $analysisRequest;

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

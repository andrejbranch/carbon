<?php

namespace AppBundle\Entity\Storage;

use AppBundle\Entity\Project;
use AppBundle\Entity\Storage\Sample;
use Carbon\ApiBundle\Annotation AS Carbon;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use JMS\Serializer\Annotation AS JMS;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Project Sample
 *
 * @ORM\Entity()
 * @ORM\Table(name="storage.project_sample", schema="storage")
 */
class ProjectSample
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
     * @var integer
     *
     * @ORM\Column(name="sample_id", type="integer")
     * @JMS\Groups({"default"})
     */
    protected $sampleId;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Storage\Sample", inversedBy="projectSamples")
     * @ORM\JoinColumn(name="sample_id", nullable=false)
     * @JMS\Groups({"default"})
     */
    protected $sample;

    public function setProject(Project $project)
    {
        $this->project = $project;
    }

    public function setSample(Sample $sample)
    {
        $this->sample = $sample;
    }

    /**
     * Gets the value of sample.
     *
     * @return mixed
     */
    public function getSample()
    {
        return $this->sample;
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
     * Gets the value of sampleId.
     *
     * @return integer
     */
    public function getSampleId()
    {
        return $this->sampleId;
    }

    /**
     * Sets the value of sampleId.
     *
     * @param integer $sampleId the sample id
     *
     * @return self
     */
    public function setSampleId($sampleId)
    {
        $this->sampleId = $sampleId;

        return $this;
    }
}

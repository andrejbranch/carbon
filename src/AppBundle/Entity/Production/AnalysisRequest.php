<?php

namespace AppBundle\Entity\Production;

use Carbon\ApiBundle\Annotation AS Carbon;
use Carbon\ApiBundle\Entity\Production\BaseRequest;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use JMS\Serializer\Annotation AS JMS;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity()
 * @ORM\Table(name="production.analysis_request", schema="production")
 * @Gedmo\Loggable
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false)
 */
class AnalysisRequest extends BaseRequest
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @JMS\Groups({"default"})
     */
    protected $id;

    /**
     * @var Protocol $protocol
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Storage\Protocol")
     * @ORM\JoinColumn(name="protocol_id", referencedColumnName="id")
     * @Gedmo\Versioned
     * @JMS\Groups({"default"})
     */
    protected $protocol;

    /**
     * @var string
     *
     * @ORM\Column(name="notes", type="text", nullable=true)
     * @JMS\Groups({"default"})
     * @Carbon\Searchable(name="name")
     */
    protected $notes;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Production\AnalysisRequestInputSample", mappedBy="request")
     */
    protected $inputSamples;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Production\AnalysisRequestOutputSample", mappedBy="request")
     */
    protected $outputSamples;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Production\AnalysisRequestProject", mappedBy="analysisRequest")
     */
    protected $analysisRequestProjects;

    /** transient */

    public $projects;

    public $samples;

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
     * Gets the value of protocol.
     *
     * @return Protocol $protocol
     */
    public function getProtocol()
    {
        return $this->protocol;
    }

    /**
     * Sets the value of protocol.
     *
     * @param Protocol $protocol $protocol the protocol
     *
     * @return self
     */
    public function setProtocol($protocol)
    {
        $this->protocol = $protocol;

        return $this;
    }

    /**
     * Gets the value of notes.
     *
     * @return string
     */
    public function getNotes()
    {
        return $this->notes;
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
     * Gets the value of inputSamples.
     *
     * @return mixed
     */
    public function getInputSamples()
    {
        return $this->inputSamples;
    }

    /**
     * Sets the value of inputSamples.
     *
     * @param mixed $inputSamples the input samples
     *
     * @return self
     */
    public function setInputSamples($inputSamples)
    {
        $this->inputSamples = $inputSamples;

        return $this;
    }

    /**
     * Gets the value of outputSamples.
     *
     * @return mixed
     */
    public function getOutputSamples()
    {
        return $this->outputSamples;
    }

    /**
     * Sets the value of outputSamples.
     *
     * @param mixed $outputSamples the output samples
     *
     * @return self
     */
    public function setOutputSamples($outputSamples)
    {
        $this->outputSamples = $outputSamples;

        return $this;
    }

    /**
     * Gets the value of analysisRequestProjects.
     *
     * @return mixed
     */
    public function getAnalysisRequestProjects()
    {
        return $this->analysisRequestProjects;
    }

    /**
     * Sets the value of analysisRequestProjects.
     *
     * @param mixed $analysisRequestProjects the analysis request projects
     *
     * @return self
     */
    public function setAnalysisRequestProjects($analysisRequestProjects)
    {
        $this->analysisRequestProjects = $analysisRequestProjects;

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
     * Gets the value of samples.
     *
     * @return mixed
     */
    public function getSamples()
    {
        return $this->samples;
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
}

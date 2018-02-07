<?php

namespace AppBundle\Entity\Production\Analysis;

use Carbon\ApiBundle\Annotation AS Carbon;
use Carbon\ApiBundle\Entity\Production\BaseRequest;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use JMS\Serializer\Annotation AS JMS;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity()
 * @ORM\Table(name="production.sds_page_request", schema="production")
 * @Gedmo\Loggable
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false)
 */
class SdsPageRequest extends BaseRequest
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
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Production\Analysis\SdsPageRequestInputSample", mappedBy="request")
     */
    protected $inputSamples;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Production\Analysis\SdsPageRequestProject", mappedBy="request")
     */
    protected $requestProjects;

    /** transient */

    public $projects;

    public $samples;

    public function getAliasPrefix()
    {
        return 'SDS';
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

    /**
     * Gets the value of type.
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Sets the value of type.
     *
     * @param string $type the type
     *
     * @return self
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Gets the value of outputSamples.
     *
     * @return mixed
     */
    public function getOutputSamples()
    {
        return $this;
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
        return $this;
    }

    /**
     * Gets the value of requestProjects.
     *
     * @return mixed
     */
    public function getRequestProjects()
    {
        return $this->requestProjects;
    }

    /**
     * Sets the value of requestProjects.
     *
     * @param mixed $requestProjects the request projects
     *
     * @return self
     */
    public function setRequestProjects($requestProjects)
    {
        $this->requestProjects = $requestProjects;

        return $this;
    }
}

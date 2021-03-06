<?php

namespace AppBundle\Entity\Production\Purification;

use Carbon\ApiBundle\Annotation AS Carbon;
use Carbon\ApiBundle\Entity\Production\BaseRequest;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use JMS\Serializer\Annotation AS JMS;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity()
 * @ORM\Table(name="production.affinity_purification_request", schema="production")
 * @Gedmo\Loggable
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false)
 */
class AffinityPurificationRequest extends BaseRequest
{
    /**
     * Valid concentration units
     *
     * @var array
     */
    protected $validConcentrationUnits = array(
        'mg/mL',
        'ng/uL',
        'Molar',
    );

    /**
     * Valid volume units
     *
     * @var array
     */
    protected $validVolumeUnits = array(
        'uL',
        'mL'
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
     * @var Protocol $protocol
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Storage\Protocol")
     * @ORM\JoinColumn(name="protocol_id", referencedColumnName="id")
     * @Gedmo\Versioned
     * @JMS\Groups({"default"})
     */
    protected $protocol;

    /**
     * @var float $volume
     *
     * @ORM\Column(name="volume", type="decimal", precision=3, nullable=true)
     * @Gedmo\Versioned
     * @JMS\Groups({"default"})
     */
    protected $volume;

    /**
     * @var string
     *
     * @ORM\Column(name="notes", type="text", nullable=true)
     * @JMS\Groups({"default"})
     * @Carbon\Searchable(name="name")
     */
    protected $notes;

    /**
     * @var string $concentrationUnits
     *
     * @ORM\Column(name="volume_units", type="string", nullable=true, length=15)
     * @JMS\Groups({"default"})
     * @Gedmo\Versioned
     */
    protected $volumeUnits;

    /**
     * @var float $concentration
     *
     * @ORM\Column(name="concentration", type="decimal", precision=20, scale=3, nullable=true)
     * @Gedmo\Versioned
     * @JMS\Groups({"default"})
     * @JMS\Type("double")
     * @Gedmo\Versioned
     */
    protected $concentration;

    /**
     * @var string $concentrationUnits
     *
     * @ORM\Column(name="concentration_units", type="string", nullable=true, length=15)
     * @JMS\Groups({"default"})
     * @Gedmo\Versioned
     */
    protected $concentrationUnits;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Production\Purification\AffinityPurificationRequestInputSample", mappedBy="request")
     */
    protected $inputSamples;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Production\Purification\AffinityPurificationRequestOutputSample", mappedBy="request")
     */
    protected $outputSamples;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Production\Purification\AffinityPurificationRequestProject", mappedBy="purificationRequest")
     */
    protected $purificationRequestProjects;

    /** transient */

    public $projects;

    public $samples;

    public function getAliasPrefix()
    {
        return 'AF';
    }

    public function getVolume()
    {
        return $this->volume;
    }

    /**
     * @JMS\VirtualProperty()
     * @JMS\Groups({"default"})
     */
    public function getConcentrationString()
    {
        return $this->concentration
            ? $this->concentration . ' ' . $this->concentrationUnits
            : ''
        ;
    }

    /**
     * @JMS\VirtualProperty()
     * @JMS\Groups({"default"})
     */
    public function getVolumeString()
    {
        return $this->volume
            ? $this->volume . ' ' . $this->volumeUnits
            : ''
        ;
    }

    /**
     * @JMS\VirtualProperty()
     * @JMS\Groups({"default"})
     */
    public function getStringLabel()
    {
        return $this->getDescription();
    }

    /**
     * Gets the Valid concentration units.
     *
     * @return array
     */
    public function getValidConcentrationUnits()
    {
        return $this->validConcentrationUnits;
    }

    /**
     * Sets the Valid concentration units.
     *
     * @param array $validConcentrationUnits the valid concentration units
     *
     * @return self
     */
    public function setValidConcentrationUnits(array $validConcentrationUnits)
    {
        $this->validConcentrationUnits = $validConcentrationUnits;

        return $this;
    }

    /**
     * Gets the Valid volume units.
     *
     * @return array
     */
    public function getValidVolumeUnits()
    {
        return $this->validVolumeUnits;
    }

    /**
     * Sets the Valid volume units.
     *
     * @param array $validVolumeUnits the valid volume units
     *
     * @return self
     */
    public function setValidVolumeUnits(array $validVolumeUnits)
    {
        $this->validVolumeUnits = $validVolumeUnits;

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
     * Sets the value of volume.
     *
     * @param float $volume $volume the volume
     *
     * @return self
     */
    public function setVolume($volume)
    {
        $this->volume = $volume;

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
     * Gets the value of volumeUnits.
     *
     * @return string $concentrationUnits
     */
    public function getVolumeUnits()
    {
        return $this->volumeUnits;
    }

    /**
     * Sets the value of volumeUnits.
     *
     * @param string $concentrationUnits $volumeUnits the volume units
     *
     * @return self
     */
    public function setVolumeUnits($volumeUnits)
    {
        $this->volumeUnits = $volumeUnits;

        return $this;
    }

    /**
     * Sets the value of concentration.
     *
     * @param float $concentration $concentration the concentration
     *
     * @return self
     */
    public function setConcentration($concentration)
    {
        $this->concentration = $concentration;

        return $this;
    }

    /**
     * Gets the value of concentrationUnits.
     *
     * @return string $concentrationUnits
     */
    public function getConcentrationUnits()
    {
        return $this->concentrationUnits;
    }

    /**
     * Sets the value of concentrationUnits.
     *
     * @param string $concentrationUnits $concentrationUnits the concentration units
     *
     * @return self
     */
    public function setConcentrationUnits($concentrationUnits)
    {
        $this->concentrationUnits = $concentrationUnits;

        return $this;
    }

    /**
     * Gets the value of purificationRequestProjects.
     *
     * @return mixed
     */
    public function getPurificationRequestProjects()
    {
        return $this->purificationRequestProjects;
    }

    /**
     * Sets the value of purificationRequestProjects.
     *
     * @param mixed $purificationRequestProjects the purification request projects
     *
     * @return self
     */
    public function setPurificationRequestProjects($purificationRequestProjects)
    {
        $this->purificationRequestProjects = $purificationRequestProjects;

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
     * Gets the value of concentration.
     *
     * @return float $concentration
     */
    public function getConcentration()
    {
        return $this->concentration;
    }
}

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
 * DNAOutputSample
 *
 * @ORM\Entity()
 * @ORM\Table(name="production.dna_output_sample", schema="production")
 */
class DNAOutputSample
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
     * @ORM\Column(name="sample_id", type="integer")
     * @JMS\Groups({"default"})
     */
    private $sampleId;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Storage\Sample", inversedBy="dnaRequestSamples")
     * @ORM\JoinColumn(name="sample_id", nullable=false)
     * @JMS\Groups({"default"})
     */
    private $sample;

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
     * Sets the value of sample.
     *
     * @param mixed $sample the sample
     *
     * @return self
     */
    public function setSample($sample)
    {
        $this->sample = $sample;

        return $this;
    }
}

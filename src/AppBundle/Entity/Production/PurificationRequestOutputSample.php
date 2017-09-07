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
 * @ORM\Table(name="production.purification_request_output_sample", schema="production")
 */
class PurificationRequestOutputSample
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
     * @ORM\Column(name="purification_request_id", type="integer")
     * @JMS\Groups({"default"})
     */
    private $purificationRequestId;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Production\PurificationRequest")
     * @ORM\JoinColumn(name="purification_request_id", nullable=false)
     * @JMS\Groups({"default"})
     */
    private $purificationRequest;

    /**
     * @var integer
     *
     * @ORM\Column(name="sample_id", type="integer")
     * @JMS\Groups({"default"})
     */
    private $sampleId;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Storage\Sample", inversedBy="purificationRequestSamples")
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
}

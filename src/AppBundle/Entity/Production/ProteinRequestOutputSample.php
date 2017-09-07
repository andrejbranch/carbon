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
 * @ORM\Table(name="production.protein_request_output_sample", schema="production")
 */
class ProteinRequestOutputSample
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
     * @ORM\Column(name="sample_id", type="integer")
     * @JMS\Groups({"default"})
     */
    private $sampleId;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Storage\Sample", inversedBy="proteinRequestSamples")
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
}

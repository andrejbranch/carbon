<?php

namespace AppBundle\Entity\Production\Analysis;

use AppBundle\Entity\Storage\Sample;
use Carbon\ApiBundle\Annotation AS Carbon;
use Carbon\ApiBundle\Entity\Production\BaseRequestSampleInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use JMS\Serializer\Annotation AS JMS;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity()
 * @ORM\Table(name="production.spr_request_input_sample", schema="production")
 */
class SprRequestInputSample implements BaseRequestSampleInterface
{
    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @JMS\Groups({"default"})
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="request_id", type="integer")
     * @JMS\Groups({"default"})
     */
    private $requestId;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Production\Analysis\SprRequest")
     * @ORM\JoinColumn(name="request_id", nullable=false)
     * @JMS\Groups({"default"})
     */
    private $request;

    /**
     * @var integer
     *
     * @ORM\Column(name="sample_id", type="integer")
     * @JMS\Groups({"default"})
     */
    private $sampleId;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Storage\Sample")
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
     * Gets the value of requestId.
     *
     * @return integer
     */
    public function getRequestId()
    {
        return $this->requestId;
    }

    /**
     * Sets the value of requestId.
     *
     * @param integer $requestId the request id
     *
     * @return self
     */
    public function setRequestId($requestId)
    {
        $this->requestId = $requestId;

        return $this;
    }

    /**
     * Gets the value of request.
     *
     * @return mixed
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * Sets the value of request.
     *
     * @param mixed $request the request
     *
     * @return self
     */
    public function setRequest($request)
    {
        $this->request = $request;

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

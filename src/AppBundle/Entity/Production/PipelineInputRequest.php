<?php

namespace AppBundle\Entity\Production;

use Carbon\ApiBundle\Annotation AS Carbon;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use JMS\Serializer\Annotation AS JMS;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity()
 * @ORM\Table(name="production.pipeline_input_request", schema="production")
 * @Gedmo\Loggable
 */
class PipelineInputRequest
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @JMS\Groups({"default"})
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Production\PipelineRequest")
     * @ORM\JoinColumn(name="from_pipeline_request_id", referencedColumnName="id")
     * @Gedmo\Versioned
     * @JMS\Groups({"default"})
     */
    private $fromPipelineRequest;

    /**
     * @ORM\Column(name="from_request_id", type="integer")
     * @Gedmo\Versioned
     * @JMS\Groups({"default"})
     */
    private $fromRequestId;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Production\PipelineRequest")
     * @ORM\JoinColumn(name="to_pipeline_request_id", referencedColumnName="id")
     * @Gedmo\Versioned
     * @JMS\Groups({"default"})
     */
    private $toPipelineRequest;

    /**
     * @ORM\Column(name="to_request_id", type="integer")
     * @Gedmo\Versioned
     * @JMS\Groups({"default"})
     */
    private $toRequestId;

    /**
     * Gets the value of id.
     *
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Sets the value of id.
     *
     * @param mixed $id the id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Gets the value of fromPipelineRequest.
     *
     * @return mixed
     */
    public function getFromPipelineRequest()
    {
        return $this->fromPipelineRequest;
    }

    /**
     * Sets the value of fromPipelineRequest.
     *
     * @param mixed $fromPipelineRequest the from pipeline request
     *
     * @return self
     */
    public function setFromPipelineRequest($fromPipelineRequest)
    {
        $this->fromPipelineRequest = $fromPipelineRequest;

        return $this;
    }

    /**
     * Gets the value of fromRequestId.
     *
     * @return mixed
     */
    public function getFromRequestId()
    {
        return $this->fromRequestId;
    }

    /**
     * Sets the value of fromRequestId.
     *
     * @param mixed $fromRequestId the from request id
     *
     * @return self
     */
    public function setFromRequestId($fromRequestId)
    {
        $this->fromRequestId = $fromRequestId;

        return $this;
    }

    /**
     * Gets the value of toPipelineRequest.
     *
     * @return mixed
     */
    public function getToPipelineRequest()
    {
        return $this->toPipelineRequest;
    }

    /**
     * Sets the value of toPipelineRequest.
     *
     * @param mixed $toPipelineRequest the to pipeline request
     *
     * @return self
     */
    public function setToPipelineRequest($toPipelineRequest)
    {
        $this->toPipelineRequest = $toPipelineRequest;

        return $this;
    }

    /**
     * Gets the value of toRequestId.
     *
     * @return mixed
     */
    public function getToRequestId()
    {
        return $this->toRequestId;
    }

    /**
     * Sets the value of toRequestId.
     *
     * @param mixed $toRequestId the to request id
     *
     * @return self
     */
    public function setToRequestId($toRequestId)
    {
        $this->toRequestId = $toRequestId;

        return $this;
    }
}

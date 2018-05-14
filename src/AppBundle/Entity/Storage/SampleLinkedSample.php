<?php

namespace AppBundle\Entity\Storage;

use AppBundle\Entity\Storage\Sample;
use Carbon\ApiBundle\Annotation AS Carbon;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use JMS\Serializer\Annotation AS JMS;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Sample Linked Sample
 *
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Storage\SampleLinkRepository")
 * @ORM\Table(name="storage.sample_linked_sample", schema="storage")
 */
class SampleLinkedSample
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
     * @ORM\Column(name="parent_sample_id", type="integer")
     * @JMS\Groups({"default"})
     */
    private $parentSampleId;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Storage\Sample")
     * @ORM\JoinColumn(name="parent_sample_id", nullable=false)
     * @JMS\Groups({"default"})
     */
    private $parentSample;

    /**
     * @var integer
     *
     * @ORM\Column(name="child_sample_id", type="integer")
     * @JMS\Groups({"default"})
     */
    private $childSampleId;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Storage\Sample")
     * @ORM\JoinColumn(name="child_sample_id", nullable=false)
     * @JMS\Groups({"default"})
     */
    private $childSample;

    public function __construct()
    {
    }

    public function getParentSampleId()
    {
        return $this->parentSampleId;
    }

    public function getChildSampleId()
    {
        return $this->childSampleId;
    }

    public function setParentSample(Sample $sample)
    {
        $this->parentSample = $sample;
    }

    public function setChildSample(Sample $childSample)
    {
        $this->childSample = $childSample;
    }
}

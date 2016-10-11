<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Sample;
use Carbon\ApiBundle\Annotation AS Carbon;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use JMS\Serializer\Annotation AS JMS;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Division Sample Type
 *
 * @ORM\Entity()
 * @ORM\Table(name="division_sample_type")
 */
class DivisionSampleType
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
     * @ORM\Column(name="sample_type_id", type="integer")
     * @JMS\Groups({"default"})
     */
    private $sampleTypeId;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\SampleType")
     * @ORM\JoinColumn(name="sample_type_id", nullable=false)
     * @JMS\Groups({"default"})
     */
    private $sampleType;

    /**
     * @var integer
     *
     * @ORM\Column(name="division_id", type="integer")
     * @JMS\Groups({"default"})
     */
    private $divisionId;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Division")
     * @ORM\JoinColumn(name="division_id", nullable=false)
     * @JMS\Groups({"default"})
     */
    private $division;

    public function setSampleType(SampleType $sampleType)
    {
        $this->sampleType = $sampleType;
    }

    public function setDivision(Division $division)
    {
        $this->division = $division;
    }
}

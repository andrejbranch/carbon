<?php

namespace AppBundle\Entity\Storage;

use AppBundle\Entity\Project;
use AppBundle\Entity\Storage\Sample;
use Carbon\ApiBundle\Annotation AS Carbon;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use JMS\Serializer\Annotation AS JMS;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Project Sample
 *
 * @ORM\Entity()
 * @ORM\Table(name="storage.project_sample", schema="storage")
 */
class ProjectSample
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
     * @ORM\Column(name="project_id", type="integer")
     * @JMS\Groups({"default"})
     */
    private $projectId;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Project")
     * @ORM\JoinColumn(name="project_id", nullable=false)
     * @JMS\Groups({"default"})
     */
    private $project;

    /**
     * @var integer
     *
     * @ORM\Column(name="sample_id", type="integer")
     * @JMS\Groups({"default"})
     */
    private $sampleId;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Storage\Sample", inversedBy="projectSamples")
     * @ORM\JoinColumn(name="sample_id", nullable=false)
     * @JMS\Groups({"default"})
     */
    private $sample;

    public function setProject(Project $project)
    {
        $this->project = $project;
    }

    public function setSample(Sample $sample)
    {
        $this->sample = $sample;
    }
}

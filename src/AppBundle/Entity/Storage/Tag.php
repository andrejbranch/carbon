<?php

namespace AppBundle\Entity\Storage;

use Carbon\ApiBundle\Annotation AS Carbon;
use Carbon\ApiBundle\Entity\Storage\BaseTag;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping AS ORM;
use Doctrine\ORM\Mapping\MappedSuperclass;
use JMS\Serializer\Annotation as JMS;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints AS Constraint;

/**
 * @ORM\Entity()
 * @ORM\Table(name="storage.tag", schema="storage")
 * @Gedmo\Loggable
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false)
 */
class Tag extends BaseTag
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @JMS\Groups("default")
     */
    protected $id;

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
     * Gets the value of tagSamples.
     *
     * @return mixed
     */
    public function getTagSamples()
    {
        return $this->sampleTypeSamples;
    }

    /**
     * Sets the value of sampleTypeSamples.
     *
     * @param mixed $tagSamples the sample type samples
     *
     * @return self
     */
    public function setTagSamples($tagSamples)
    {
        $this->tagSamples = $tagSamples;

        return $this;
    }
}

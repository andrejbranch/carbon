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
 * Division Storage Container
 *
 * @ORM\Entity()
 * @ORM\Table(name="division_storage_container")
 */
class DivisionStorageContainer
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
     * @ORM\Column(name="storage_container_id", type="integer")
     * @JMS\Groups({"default"})
     */
    private $storageContainerId;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\StorageContainer")
     * @ORM\JoinColumn(name="storage_container_id", nullable=false)
     * @JMS\Groups({"default"})
     */
    private $storageContainer;

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

    public function setStorageContainer(StorageContainer $storageContainer)
    {
        $this->storageContainer = $storageContainer;
    }

    public function setDivision(Division $division)
    {
        $this->division = $division;
    }
}

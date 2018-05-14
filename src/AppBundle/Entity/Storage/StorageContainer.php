<?php

namespace AppBundle\Entity\Storage;

use Carbon\ApiBundle\Annotation AS Carbon;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation AS JMS;
use Carbon\ApiBundle\Entity\Storage\BaseStorageContainer;

/**
 * StorageContainer
 *
 * @ORM\Entity()
 * @ORM\Table(name="storage.storage_container", schema="storage")
 */
class StorageContainer extends BaseStorageContainer
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @JMS\Groups({"default"})
     */
    private $id;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}

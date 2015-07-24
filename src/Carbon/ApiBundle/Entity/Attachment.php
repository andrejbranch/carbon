<?php

namespace Carbon\ApiBundle\Entity;

use Carbon\ApiBundle\Annotation AS Carbon;
use Doctrine\ORM\Mapping AS ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints AS Constraint;

/**
 * @ORM\Entity()
 * @ORM\Table(name="attachment")
 *
 * The entity model for an object attachment
 *
 * @version 1.01
 * @author Andre Jon Branchizio <andrejbranch@gmail.com>
 */
class Attachment
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     * @var int the attachment id
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=55)
     *
     * @var string the name of the original file
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string path to the file for downloads
     */
    private $downloadPath;

    /**
     * @ORM\Column(type="string")
     *
     * @var string mime type of the attachment
     */
    private $mimeType;

    /**
     * @ORM\Column(type="integer")
     *
     * @var int attachments file size in bytes
     */
    private $size;

    /**
     * @ORM\Column(type="datetime")
     * @Gedmo\Timestampable(on="update")
     *
     * @var \DateTime $updated
     */
    private $updatedAt;

    /**
     * @ORM\Column(name="deletedAt", type="datetime", nullable=true)
     */
    private $deletedAt;

    /**
     * Set the attachment id
     *
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Get the attachment id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the attachments original file name
     *
     * @param type $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Get the attachments original file name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the attachments download path
     *
     * @param type $name
     */
    public function setDownloadPath($downloadPath)
    {
        $this->downloadPath = $downloadPath;
    }

    /**
     * Get the attachments download path
     *
     * @return string
     */
    public function getDownloadPath()
    {
        return $this->downloadPath;
    }

    /**
     * Set the attachments mime type
     *
     * @param string $mimeType
     */
    public function setMimeType($mimeType)
    {
        $this->mimeType = $mimeType;
    }

    /**
     * Get the attachments mime type
     *
     * @return string
     */
    public function getMimeType()
    {
        return $this->mimeType;
    }

    /**
     * Set the attachments file size
     *
     * @param int $size
     */
    public function setSize($size)
    {
        $this->size = (int) $size;
    }

    /**
     * Get the attachments file size
     *
     * @return int
     */
    public function getSize()
    {
        return $this->size;
    }
}

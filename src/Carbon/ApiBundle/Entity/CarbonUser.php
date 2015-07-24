<?php

namespace Carbon\ApiBundle\Entity;

use Carbon\ApiBundle\Annotation AS Carbon;
use Doctrine\ORM\Mapping AS ORM;
use Doctrine\ORM\Mapping\MappedSuperclass;
use Uecode\Bundle\ApiKeyBundle\Entity\ApiKeyUser as BaseUser;

/**
 * @MappedSuperclass
 */
class CarbonUser extends BaseUser
{
    /**
     * The profile photo/avatar attachment
     *
     * @ORM\OneToOne(targetEntity="Carbon\ApiBundle\Entity\Attachment")
     * @ORM\JoinColumn(name="avatar_attachment_id", nullable=true)
     * @var Carbon\ApiBundle\Entity\Attachment
     */
    protected $avatarAttachment;

    public function __construct()
    {
        parent::__construct();
    }

    public function setAvatarAttachment(Attachment $avatarAttachment)
    {
        $this->avatarAttachment = $avatarAttachment;
    }

    public function getAvatarAttachment()
    {
        return $this->avatarAttachment;
    }

    /**
     * Does the user have an avatar or not
     *
     * @return boolean
     */
    public function hasAvatar()
    {
        return NULL !== $this->avatarAttachment->getId();
    }
}

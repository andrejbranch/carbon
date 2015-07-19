<?php

namespace Carbon\ApiBundle\Entity;

use Carbon\ApiBundle\Annotation AS Carbon;
use Doctrine\ORM\Mapping AS ORM;
use Doctrine\ORM\Mapping\MappedSuperclass;
use FOS\UserBundle\Model\User;
use Uecode\Bundle\ApiKeyBundle\Entity\ApiKeyUser as BaseUser;

/**
 * @MappedSuperclass
 */
class CarbonUser extends BaseUser
{
    /**
     * Path to avatar img
     *
     * @ORM\Column(type="string", nullable=true)
     * @var string
     */
    protected $avatarPath;

    public function __construct()
    {
        parent::__construct();
    }

    public function setAvatarPath($avatarPath)
    {
        $this->avatarPath = $avatarPath;
    }

    public function getAvatarPath()
    {
        return $this->avatarPath;
    }
}

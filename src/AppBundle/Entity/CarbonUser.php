<?php

namespace AppBundle\Entity;

use Carbon\ApiBundle\Annotation AS Carbon;
use Doctrine\ORM\Mapping AS ORM;
use FOS\UserBundle\Model\User;
use Uecode\Bundle\ApiKeyBundle\Entity\ApiKeyUser as BaseUser;

/**
 * @ORM\Entity()
 * @ORM\Table(name="carbon_user")
 *
 * The entity model for a carbon user
 *
 * @version 1.01
 * @author Andre Jon Branchizio <andrejbranch@gmail.com>
 */
class CarbonUser extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     * @var int the cards id
     */
    protected $id;

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

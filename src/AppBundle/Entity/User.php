<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping AS ORM;
use Carbon\ApiBundle\Entity\CarbonUser;

/**
 * @ORM\Entity()
 * @ORM\Table(name="user")
 *
 * The entity model for a user
 *
 * @version 1.01
 * @author Andre Jon Branchizio <andrejbranch@gmail.com>
 */
class User extends CarbonUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     * @var int the cards id
     */
    protected $id;

    public function __construct()
    {
        parent::__construct();
    }
}

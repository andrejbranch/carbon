<?php

namespace AppBundle\Entity;

use Carbon\ApiBundle\Annotation AS Carbon;
use Doctrine\ORM\Mapping AS ORM;
use FOS\UserBundle\Model\User;

/**
 * @ORM\Entity()
 * @ORM\Table(name="carbon_user")
 *
 * The entity model for a carbon user
 *
 * @version 1.01
 * @author Andre Jon Branchizio <andrejbranch@gmail.com>
 */
class CarbonUser extends  User
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


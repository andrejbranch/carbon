<?php

namespace Carbon\ApiBundle\Entity;

use Carbon\ApiBundle\Annotation AS Carbon;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping AS ORM;
use Doctrine\ORM\Mapping\MappedSuperclass;
use Uecode\Bundle\ApiKeyBundle\Entity\ApiKeyUser as BaseUser;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints AS Constraint;

/**
 * @MappedSuperclass
 * @UniqueEntity(
 *     fields={"email"},
 *     message="The email address provided is already associated with another account."
 * )
 * @UniqueEntity(
 *     fields={"username"},
 *     message="The username provided is already associated with another account."
 * )
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

    /**
     * @ORM\Column(type="string", length=55)
     * @Constraint\NotNull(message="First name is required")
     *
     * @var string the users first name
     */
    protected $firstName;

    /**
     * @ORM\Column(type="string", length=55)
     * @Constraint\NotNull(message="Last name is required")
     *
     * @var string the users last name
     */
    protected $lastName;

    /**
     * @ORM\ManyToMany(targetEntity="Carbon\ApiBundle\Entity\Role")
     * @ORM\JoinTable(name="user_role")
     */
    protected $roles;

    public function __construct()
    {
        parent::__construct();
        $this->roles = new ArrayCollection();

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

    /**
     * Set the users first name
     *
     * @param string $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * Get the users first name
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set the users last name
     *
     * @param string $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * Get the users last name
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Get the users full name
     *
     * @return string
     */
    public function getFullName()
    {
        return $this->firstName . ' ' . $this->lastName;
    }

    /**
     * Returns an ARRAY of Role objects with the default Role object appended.
     * @return array
     */
    public function getRoles()
    {
        return array_merge( $this->roles->toArray(), array( new Role( parent::ROLE_DEFAULT ) ) );
    }

    /**
     * Returns the true ArrayCollection of Roles.
     * @return Doctrine\Common\Collections\ArrayCollection
     */
    public function getRolesCollection()
    {
        return $this->roles;
    }

    /**
     * Pass a string, get the desired Role object or null.
     * @param string $role
     * @return Role|null
     */
    public function getRole( $role )
    {
        foreach ( $this->getRoles() as $roleItem )
        {
            if ( $role == $roleItem->getRole() )
            {
                return $roleItem;
            }
        }
        return null;
    }

    /**
     * Pass a string, checks if we have that Role. Same functionality as getRole() except returns a real boolean.
     * @param string $role
     * @return boolean
     */
    public function hasRole( $role )
    {
        if ( $this->getRole( $role ) )
        {
            return true;
        }
        return false;
    }

    /**
     * Adds a Role OBJECT to the ArrayCollection. Can't type hint due to interface so throws Exception.
     * @throws Exception
     * @param Role $role
     */
    public function addRole( $role )
    {
        if ( !$role instanceof Role )
        {
            throw new \Exception( "addRole takes a Role object as the parameter" );
        }

        if ( !$this->hasRole( $role->getRole() ) )
        {
            $this->roles->add( $role );
        }
    }

    /**
     * Pass a string, remove the Role object from collection.
     * @param string $role
     */
    public function removeRole( $role )
    {
        $roleElement = $this->getRole( $role );
        if ( $roleElement )
        {
            $this->roles->removeElement( $roleElement );
        }
    }

    /**
     * Pass an ARRAY of Role objects and will clear the collection and re-set it with new Roles.
     * Type hinted array due to interface.
     * @param array $roles Of Role objects.
     */
    public function setRoles( array $roles )
    {
        $this->roles->clear();
        foreach ( $roles as $role )
        {
            $this->addRole( $role );
        }
    }

    /**
     * Directly set the ArrayCollection of Roles. Type hinted as Collection which is the parent of (Array|Persistent)Collection.
     * @param Doctrine\Common\Collections\Collection $role
     */
    public function setRolesCollection( Collection $collection )
    {
        $this->roles = $collection;
    }
}

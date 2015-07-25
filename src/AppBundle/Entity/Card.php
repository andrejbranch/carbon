<?php

namespace AppBundle\Entity;

use Carbon\ApiBundle\Annotation\Searchable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping AS ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use JMS\Serializer\Annotation\Exclude;
use JMS\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints AS Constraint;

/**
 * @ORM\Entity(repositoryClass="CardRepository")
 * @ORM\Table(name="cards")
 * @Gedmo\Loggable
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false)
 *
 * The entity model for a card in a deck
 *
 * @version 1.01
 * @author Andre Jon Branchizio <andrejbranch@gmail.com>
 */
class Card
{
    /**
     * @var string the club suit type
     */
    const SUIT_CLUB = "Club";

    /**
     * @var string the diamond suit type
     */
    const SUIT_DIAMOND = "Diamond";

    /**
     * @var string the heart suit type
     */
    const SUIT_HEART = "Heart";

    /**
     * @var string the spade suit type
     */
    const SUIT_SPADE = "Spade";

    /**
     * @var array valid suit values
     */
    public static $validSuits = array(
        self::SUIT_CLUB,
        self::SUIT_DIAMOND,
        self::SUIT_HEART,
        self::SUIT_SPADE,
    );

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @Groups({"default"})
     *
     * @var int the cards id
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=5)
     * @Searchable(name="name")
     * @Constraint\NotNull(message="Name is required")
     * @Gedmo\Versioned
     * @Groups({"default"})
     *
     * @var string the name of the card
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=8)
     * @Searchable(name="suit")
     * @Constraint\NotNull(message="Suit is required")
     * @Groups({"default"})
     *
     * @var string the suit type of the card
     */
    private $suit;

    /**
     * @ORM\Column(type="integer", length=2)
     * @Constraint\NotNull(message="Power is required")
     * @Gedmo\Versioned
     * @Groups({"default"})
     *
     * @var int the relative power of the card
     */
    private $power;

    /**
     * @ORM\Column(type="datetime")
     * @Gedmo\Timestampable(on="update")
     * @Groups({"default"})
     *
     * @var \DateTime $updated
     */
    private $updatedAt;

    /**
     * @ORM\Column(name="deletedAt", type="datetime", nullable=true)
     * @Gedmo\Versioned
     */
    private $deletedAt;

    /**
     * Converts the card object to a string value
     *
     * @return string
     */
    public function __tostring()
    {
        return sprintf('%s of %ss', $this->name, $this->suit);
    }

    /**
     * Set the id of the card
     *
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Get the id of the card
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the name of the card
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Get the name of the card
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the suit of the card
     *
     * @param string $suit
     * @throws InvalidArgumentException if the provided suit is not in the valid suits array
     */
    public function setSuit($suit)
    {
        if (!in_array($suit, self::$validSuits)) {
            throw new \InvalidArgumentException(sprintf('%s is not a valid suit', $suit));
        }

        $this->suit = $suit;
    }

    /**
     * Get the suit of the card
     *
     * @return string
     */
    public function getSuit()
    {
        return $this->suit;
    }

    /**
     * Set the relative power of the card
     *
     * @param int $power
     */
    public function setPower($power)
    {
        $this->power = $power;
    }

    /**
     * Get the relative power of the card
     *
     * @return int
     */
    public function getPower()
    {
        return $this->power;
    }

    /**
     * Get updated at date time
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set updated at date time
     *
     * @return {void}
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    public function getDeletedAt()
    {
        return $this->deletedAt;
    }

    public function setDeletedAt($deletedAt)
    {
        $this->deletedAt = $deletedAt;
    }
}

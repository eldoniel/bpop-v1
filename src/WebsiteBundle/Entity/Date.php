<?php

namespace WebsiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Date
 *
 * @ORM\Table(name="date")
 * @ORM\Entity(repositoryClass="WebsiteBundle\Repository\DateRepository")
 */
class Date
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="event_name", type="string", length=255, nullable=true)
     */
    private $eventName;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_show", type="datetime")
     */
    private $dateShow;

    /**
     * @var string
     *
     * @ORM\Column(name="room", type="string", length=255, nullable=true)
     */
    private $room;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=255)
     */
    private $city;

    /**
     * @var string
     *
     * @ORM\Column(name="poster", type="string", length=255, nullable=true)
     *
     * @Assert\NotBlank(message="Merci d'upload le fichier en jpg")
     * @Assert\File(mimeTypes={ "image/jpeg" })
     */
    private $poster;

    /**
     * @var string
     *
     * @ORM\Column(name="otherBands", type="string", length=255, nullable=true)
     */
    private $otherBands;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float", nullable=true)
     */
    private $price;

    /**
     * @var string
     *
     * @ORM\Column(name="sellersLink", type="string", nullable=true)
     */
    private $sellersLink;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set eventName
     *
     * @param string $eventName
     *
     * @return Date
     */
    public function setEventName($eventName)
    {
        $this->eventName = $eventName;

        return $this;
    }

    /**
     * Get eventName
     *
     * @return string
     */
    public function getEventName()
    {
        return $this->eventName;
    }

    /**
     * Set dateShow
     *
     * @param \DateTime $dateShow
     *
     * @return Date
     */
    public function setDateShow($dateShow)
    {
        $this->dateShow = $dateShow;

        return $this;
    }

    /**
     * Get dateShow
     *
     * @return \DateTime
     */
    public function getDateShow()
    {
        return $this->dateShow;
    }

    /**
     * Set room
     *
     * @param string $room
     *
     * @return Date
     */
    public function setRoom($room)
    {
        $this->room = $room;

        return $this;
    }

    /**
     * Get room
     *
     * @return string
     */
    public function getRoom()
    {
        return $this->room;
    }

    /**
     * Set city
     *
     * @param string $city
     *
     * @return Date
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set poster
     *
     * @param string $poster
     *
     * @return Date
     */
    public function setPoster($poster)
    {
        $this->poster = $poster;

        return $this;
    }

    /**
     * Get poster
     *
     * @return string
     */
    public function getPoster()
    {
        return $this->poster;
    }

    /**
     * Set otherBands
     *
     * @param string $otherBands
     *
     * @return Date
     */
    public function setOtherBands($otherBands)
    {
        $this->otherBands = $otherBands;

        return $this;
    }

    /**
     * Get otherBands
     *
     * @return string
     */
    public function getOtherBands()
    {
        return $this->otherBands;
    }

    /**
     * Set price
     *
     * @param float $price
     *
     * @return Date
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set sellersLink
     *
     * @param string $sellersLink
     *
     * @return Date
     */
    public function setSellersLink($sellersLink)
    {
        $this->sellersLink = $sellersLink;

        return $this;
    }

    /**
     * Get sellersLink
     *
     * @return string
     */
    public function getSellersLink()
    {
        return $this->sellersLink;
    }
}

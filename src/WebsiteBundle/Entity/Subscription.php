<?php

namespace WebsiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Subscription
 *
 * @ORM\Table(name="subscription")
 * @ORM\Entity(repositoryClass="WebsiteBundle\Repository\SubscriptionRepository")
 */
class Subscription
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
     * @ORM\Column(name="mail", type="string", length=255, unique=true)
     */
    private $mail;

    /**
     * @var bool
     *
     * @ORM\Column(name="news", type="boolean")
     */
    private $news;

    /**
     * @var bool
     *
     * @ORM\Column(name="dates", type="boolean")
     */
    private $dates;

    /**
     * @var bool
     *
     * @ORM\Column(name="music", type="boolean")
     */
    private $music;


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
     * Set mail
     *
     * @param string $mail
     *
     * @return Subscription
     */
    public function setMail($mail)
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * Get mail
     *
     * @return string
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Set news
     *
     * @param boolean $news
     *
     * @return Subscription
     */
    public function setNews($news)
    {
        $this->news = $news;

        return $this;
    }

    /**
     * Get news
     *
     * @return bool
     */
    public function getNews()
    {
        return $this->news;
    }

    /**
     * Set dates
     *
     * @param boolean $dates
     *
     * @return Subscription
     */
    public function setDates($dates)
    {
        $this->dates = $dates;

        return $this;
    }

    /**
     * Get dates
     *
     * @return bool
     */
    public function getDates()
    {
        return $this->dates;
    }

    /**
     * Set music
     *
     * @param boolean $music
     *
     * @return Subscription
     */
    public function setMusic($music)
    {
        $this->music = $music;

        return $this;
    }

    /**
     * Get music
     *
     * @return bool
     */
    public function getMusic()
    {
        return $this->music;
    }
}

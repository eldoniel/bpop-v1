<?php

namespace WebsiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ScPlaylist
 *
 * @ORM\Table(name="sc_playlist")
 * @ORM\Entity(repositoryClass="WebsiteBundle\Repository\ScPlaylistRepository")
 */
class ScPlaylist
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
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="text")
     */
    private $url;

    /**
     * @var string
     *
     * @ORM\Column(name="miniurl", type="text")
     */
    private $miniurl;


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
     * Set title
     *
     * @param string $title
     *
     * @return ScPlaylist
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set url
     *
     * @param string $url
     *
     * @return ScPlaylist
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set miniurl
     *
     * @param string $miniurl
     *
     * @return ScPlaylist
     */
    public function setMiniurl($miniurl)
    {
        $this->miniurl = $miniurl;

        return $this;
    }

    /**
     * Get miniurl
     *
     * @return string
     */
    public function getMiniurl()
    {
        return $this->miniurl;
    }
}

<?php

namespace Meesters\ForumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Meesters\ForumBundle\Entity\Topic
 */
class Topic
{
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var string $name
     */
    private $name;

    /**
     * @var datetime $time
     */
    private $time;

    /**
     * @var integer $views
     */
    private $views;

    /**
     * @var boolean $sticky
     */
    private $sticky;

    /**
     * @var boolean $closed
     */
    private $closed;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $posts;

    /**
     * @var Meesters\ForumBundle\Entity\Forum
     */
    private $forum;

    /**
     * @var Meesters\UserBundle\Entity\User
     */
    private $user;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $readers;

    public function __construct()
    {
        $this->posts   = new \Doctrine\Common\Collections\ArrayCollection();
        $this->readers = new \Doctrine\Common\Collections\ArrayCollection();
        $this->closed  = false;
        $this->sticky  = false;
        $this->views   = 0;
    }
    
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Topic
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set time
     *
     * @param datetime $time
     * @return Topic
     */
    public function setTime($time)
    {
        $this->time = $time;
        return $this;
    }

    /**
     * Get time
     *
     * @return datetime 
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * Set views
     *
     * @param integer $views
     * @return Topic
     */
    public function setViews($views)
    {
        $this->views = $views;
        return $this;
    }

    /**
     * Get views
     *
     * @return integer 
     */
    public function getViews()
    {
        return $this->views;
    }

    /**
     * Set sticky
     *
     * @param boolean $sticky
     * @return Topic
     */
    public function setSticky($sticky)
    {
        $this->sticky = $sticky;
        return $this;
    }

    /**
     * Get sticky
     *
     * @return boolean 
     */
    public function getSticky()
    {
        return $this->sticky;
    }

    /**
     * Set closed
     *
     * @param boolean $closed
     * @return Topic
     */
    public function setClosed($closed)
    {
        $this->closed = $closed;
        return $this;
    }

    /**
     * Get closed
     *
     * @return boolean 
     */
    public function getClosed()
    {
        return $this->closed;
    }

    /**
     * Add posts
     *
     * @param Meesters\ForumBundle\Entity\Post $posts
     * @return Topic
     */
    public function addPost(\Meesters\ForumBundle\Entity\Post $posts)
    {
        $this->posts[] = $posts;
        return $this;
    }
    
//    /**
//     * Remove posts
//     *
//     * @param Meesters\ForumBundle\Entity\Post $posts
//     * @return Topic
//     */
//    public function removePost(\Meesters\ForumBundle\Entity\Post $posts)
//    {
//        $this->posts->removeElement($posts);
//        return $this;
//    }

    /**
     * Get posts
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getPosts()
    {
        return $this->posts;
    }
        
//    /**
//     * Set posts
//     * 
//     * @param Meesters\ForumBundle\Entity\Post $post 
//     */
//    public function setPosts($post)
//    {
//        $this->posts->add($post);
//    }

    /**
     * Set forum
     *
     * @param Meesters\ForumBundle\Entity\Forum $forum
     * @return Topic
     */
    public function setForum(\Meesters\ForumBundle\Entity\Forum $forum = null)
    {
        $this->forum = $forum;
        return $this;
    }

    /**
     * Get forum
     *
     * @return Meesters\ForumBundle\Entity\Forum 
     */
    public function getForum()
    {
        return $this->forum;
    }

    /**
     * Set user
     *
     * @param Meesters\UserBundle\Entity\User $user
     * @return Topic
     */
    public function setUser(\Meesters\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;
        return $this;
    }

    /**
     * Get user
     *
     * @return Meesters\UserBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Add readers
     *
     * @param Meesters\UserBundle\Entity\User $readers
     * @return Topic
     */
    public function addUser(\Meesters\UserBundle\Entity\User $readers)
    {
        $this->readers[] = $readers;
        return $this;
    }

    /**
     * Get readers
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getReaders()
    {
        return $this->readers;
    }
    
    public function create()
    {
        $this->time = new \DateTime();
    }
    
}
<?php

namespace Meesters\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Entity\User as BaseUser;

/**
 * Meesters\UserBundle\Entity\User
 */
class User extends BaseUser
{
    /**
     * @var integer $id
     */
    protected $id;


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
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $topics;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $posts;

    public function __construct()
    {
        $this->topics = new \Doctrine\Common\Collections\ArrayCollection();
        $this->posts = new \Doctrine\Common\Collections\ArrayCollection();
        parent::__construct();
    }
    
    /**
     * Add topics
     *
     * @param Meesters\ForumBundle\Entity\Topic $topics
     * @return User
     */
    public function addTopic(\Meesters\ForumBundle\Entity\Topic $topics)
    {
        $this->topics[] = $topics;
        return $this;
    }

    /**
     * Get topics
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getTopics()
    {
        return $this->topics;
    }

    /**
     * Add posts
     *
     * @param Meesters\ForumBundle\Entity\Post $posts
     * @return User
     */
    public function addPost(\Meesters\ForumBundle\Entity\Post $posts)
    {
        $this->posts[] = $posts;
        return $this;
    }

    /**
     * Get posts
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getPosts()
    {
        return $this->posts;
    }
}
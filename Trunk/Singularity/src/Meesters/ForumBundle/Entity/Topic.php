<?php

namespace Meesters\ForumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Meesters\ForumBundle\Entity\Topic
 */
class Topic
{

//    public function __construct()
//    {
//        $this->posts   = new \Doctrine\Common\Collections\ArrayCollection();
//        $this->readers = new \Doctrine\Common\Collections\ArrayCollection();
//        $this->closed  = false;
//        $this->sticky  = false;
//        $this->views   = 0;
//    }
    
//    /**
//     * Add posts
//     *
//     * @param Meesters\ForumBundle\Entity\Post $posts
//     * @return Topic
//     */
//    public function addPost(\Meesters\ForumBundle\Entity\Post $posts)
//    {   
//        $this->posts[] = $posts;
//        
//        // Update topic
//        $this->time = new \DateTime();
//        
//        return $this;
//    }
//    
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
     * @var integer $view_count
     */
    private $view_count;

    /**
     * @var integer $reply_count
     */
    private $reply_count;

    /**
     * @var boolean $sticky
     */
    private $sticky;

    /**
     * @var boolean $closed
     */
    private $closed;

    /**
     * @var Meesters\ForumBundle\Entity\Post
     */
    private $first_post;

    /**
     * @var Meesters\ForumBundle\Entity\Post
     */
    private $last_post;

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
        $this->posts       = new \Doctrine\Common\Collections\ArrayCollection();
        $this->readers     = new \Doctrine\Common\Collections\ArrayCollection();
        $this->closed      = false;
        $this->sticky      = false;
        $this->view_count  = 0;
        $this->reply_count = -1;
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
     * Set view_count
     *
     * @param integer $viewCount
     * @return Topic
     */
    public function setViewCount($viewCount)
    {
        $this->view_count = $viewCount;
        return $this;
    }

    /**
     * Get view_count
     *
     * @return integer 
     */
    public function getViewCount()
    {
        return $this->view_count;
    }

    /**
     * Set reply_count
     *
     * @param integer $replyCount
     * @return Topic
     */
    public function setReplyCount($replyCount)
    {
        $this->reply_count = $replyCount;
        return $this;
    }

    /**
     * Get reply_count
     *
     * @return integer 
     */
    public function getReplyCount()
    {
        return $this->reply_count;
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
     * Set first_post
     *
     * @param Meesters\ForumBundle\Entity\Post $firstPost
     * @return Topic
     */
    public function setFirstPost(\Meesters\ForumBundle\Entity\Post $firstPost = null)
    {
        $this->first_post = $firstPost;
        return $this;
    }

    /**
     * Get first_post
     *
     * @return Meesters\ForumBundle\Entity\Post 
     */
    public function getFirstPost()
    {
        return $this->first_post;
    }

    /**
     * Set last_post
     *
     * @param Meesters\ForumBundle\Entity\Post $lastPost
     * @return Topic
     */
    public function setLastPost(\Meesters\ForumBundle\Entity\Post $lastPost = null)
    {
        $this->last_post = $lastPost;
        return $this;
    }

    /**
     * Get last_post
     *
     * @return Meesters\ForumBundle\Entity\Post 
     */
    public function getLastPost()
    {
        return $this->last_post;
    }

    /**
     * Add posts
     *
     * @param Meesters\ForumBundle\Entity\Post $posts
     * @return Topic
     */
    public function addPost(\Meesters\ForumBundle\Entity\Post $posts)
    {           
        // Update topic
        $this->last_post = $posts;
        $this->time = new \DateTime();
        
        $this->posts[] = $posts;
        $this->reply_count++;
        
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
    /**
     * @ORM\PrePersist
     */
    public function create()
    {
        
    }
}
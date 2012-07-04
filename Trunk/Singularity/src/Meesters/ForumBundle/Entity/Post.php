<?php

namespace Meesters\ForumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Meesters\ForumBundle\Entity\Post
 */
class Post
{
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var text $message
     */
    private $message;

    /**
     * @var datetime $time
     */
    private $time;

    /**
     * @var integer $edit_count
     */
    private $edit_count;

    /**
     * @var datetime $edit_time
     */
    private $edit_time;

    /**
     * @var Meesters\ForumBundle\Entity\Topic
     */
    private $topic;

    /**
     * @var Meesters\UserBundle\Entity\User
     */
    private $user;

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
     * Set message
     *
     * @param text $message
     * @return Post
     */
    public function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }

    /**
     * Get message
     *
     * @return text 
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set time
     *
     * @param datetime $time
     * @return Post
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
     * Set edit_count
     *
     * @param integer $editCount
     * @return Post
     */
    public function setEditCount($editCount)
    {
        $this->edit_count = $editCount;
        return $this;
    }

    /**
     * Get edit_count
     *
     * @return integer 
     */
    public function getEditCount()
    {
        return $this->edit_count;
    }

    /**
     * Set edit_time
     *
     * @param datetime $editTime
     * @return Post
     */
    public function setEditTime($editTime)
    {
        $this->edit_time = $editTime;
        return $this;
    }

    /**
     * Get edit_time
     *
     * @return datetime 
     */
    public function getEditTime()
    {
        return $this->edit_time;
    }

    /**
     * Set topic
     *
     * @param Meesters\ForumBundle\Entity\Topic $topic
     * @return Post
     */
    public function setTopic(\Meesters\ForumBundle\Entity\Topic $topic = null)
    {
        $this->topic = $topic;
        return $this;
    }

    /**
     * Get topic
     *
     * @return Meesters\ForumBundle\Entity\Topic 
     */
    public function getTopic()
    {
        return $this->topic;
    }

    /**
     * Set user
     *
     * @param Meesters\UserBundle\Entity\User $user
     * @return Post
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
    
    public function create()
    {
        $this->time       = new \DateTime();
        $this->edit_count = 0;
    }
    
    public function update()
    {
        $this->edit_count++;
        $this->edit_time = new \DateTime();
    }
    
}
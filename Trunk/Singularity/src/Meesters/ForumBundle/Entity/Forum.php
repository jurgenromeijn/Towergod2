<?php

namespace Meesters\ForumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Meesters\ForumBundle\Entity\Forum
 */
class Forum
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
     * @var text $description
     */
    private $description;

    /**
     * @var integer $topic_count
     */
    private $topic_count;

    /**
     * @var integer $post_count
     */
    private $post_count;

    /**
     * @var smallint $position
     */
    private $position;

    /**
     * @var Meesters\ForumBundle\Entity\Post
     */
    private $last_post;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $topics;

    /**
     * @var Meesters\ForumBundle\Entity\Category
     */
    private $category;

    public function __construct()
    {
        $this->topics = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Forum
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
     * Set description
     *
     * @param text $description
     * @return Forum
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * Get description
     *
     * @return text 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set topic_count
     *
     * @param integer $topicCount
     * @return Forum
     */
    public function setTopicCount($topicCount)
    {
        $this->topic_count = $topicCount;
        return $this;
    }

    /**
     * Get topic_count
     *
     * @return integer 
     */
    public function getTopicCount()
    {
        return $this->topic_count;
    }

    /**
     * Set post_count
     *
     * @param integer $postCount
     * @return Forum
     */
    public function setPostCount($postCount)
    {
        $this->post_count = $postCount;
        return $this;
    }

    /**
     * Get post_count
     *
     * @return integer 
     */
    public function getPostCount()
    {
        return $this->post_count;
    }

    /**
     * Set position
     *
     * @param smallint $position
     * @return Forum
     */
    public function setPosition($position)
    {
        $this->position = $position;
        return $this;
    }

    /**
     * Get position
     *
     * @return smallint 
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set last_post
     *
     * @param Meesters\ForumBundle\Entity\Post $lastPost
     * @return Forum
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
     * Add topics
     *
     * @param Meesters\ForumBundle\Entity\Topic $topics
     * @return Forum
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
     * Set category
     *
     * @param Meesters\ForumBundle\Entity\Category $category
     * @return Forum
     */
    public function setCategory(\Meesters\ForumBundle\Entity\Category $category = null)
    {
        $this->category = $category;
        return $this;
    }

    /**
     * Get category
     *
     * @return Meesters\ForumBundle\Entity\Category 
     */
    public function getCategory()
    {
        return $this->category;
    }
}
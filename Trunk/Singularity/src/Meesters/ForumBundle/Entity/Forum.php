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
     * @var smallint $position
     */
    private $position;

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
    
    public function __toString()
    {
        return $this->name;
    }
    
}
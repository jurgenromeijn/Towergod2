<?php

namespace Meesters\ForumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Meesters\ForumBundle\Entity\Category
 */
class Category
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
     * @var smallint $position
     */
    private $position;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $forums;

    public function __construct()
    {
        $this->forums = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Category
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
     * Set position
     *
     * @param smallint $position
     * @return Category
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
     * Add forums
     *
     * @param Meesters\ForumBundle\Entity\Forum $forums
     * @return Category
     */
    public function addForum(\Meesters\ForumBundle\Entity\Forum $forums)
    {
        $this->forums[] = $forums;
        return $this;
    }

    /**
     * Get forums
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getForums()
    {
        return $this->forums;
    }
}
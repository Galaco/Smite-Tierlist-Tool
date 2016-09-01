<?php

namespace GodBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table[name="god_recommended_item"]
 * @ORM\Entity
 */
class GodRecommendedItem
{
	/**
	 * @ORM\Id
	 * @Assert\NotBlank()
     * @ORM\OneToOne(targetEntity="GodBundle\Entity\God")
     * @ORM\JoinColumn(name="god_id", referencedColumnName="id")
	 */
	protected $god_id;
	
	/**
	 * @ORM\Id
	 * @Assert\NotBlank()
     * @ORM\OneToOne(targetEntity="ItemBundle\Entity\Item")
     * @ORM\JoinColumn(name="item_id", referencedColumnName="id")
	 */
	protected $item_id;
	 
	/**
	 * @Assert\NotBlank()
	 * @ORM\Column(type="text")
	 */
	protected $category;
	 
	/**
	 * @Assert\NotBlank()
	 * @ORM\Column(type="text")
	 */
	protected $item_name;
	
	/**
	 * @Assert\NotBlank()
	 * @ORM\Column(type="string", length=64)
	 */
	protected $role;

    /**
     * Set category
     *
     * @param string $category
     * @return GodRecommendedItem
     */
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return string 
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set item_name
     *
     * @param string $itemName
     * @return GodRecommendedItem
     */
    public function setItemName($itemName)
    {
        $this->item_name = $itemName;

        return $this;
    }

    /**
     * Get item_name
     *
     * @return string 
     */
    public function getItemName()
    {
        return $this->item_name;
    }

    /**
     * Set role
     *
     * @param string $role
     * @return GodRecommendedItem
     */
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get role
     *
     * @return string 
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set god_id
     *
     * @param integer $godId
     * @return GodRecommendedItem
     */
    public function setGodId($godId)
    {
        $this->god_id = $godId;

        return $this;
    }

    /**
     * Get god_id
     *
     * @return integer 
     */
    public function getGodId()
    {
        return $this->god_id;
    }

    /**
     * Set item_id
     *
     * @param integer $itemId
     * @return GodRecommendedItem
     */
    public function setItemId($itemId)
    {
        $this->item_id = $itemId;

        return $this;
    }

    /**
     * Get item_id
     *
     * @return integer 
     */
    public function getItemId()
    {
        return $this->item_id;
    }
}

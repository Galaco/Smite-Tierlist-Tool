<?php

namespace ItemBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table[name="item"]
 * @ORM\Entity
 */
class Item
{
	/**
	 * @Assert\NotBlank()
	 * @ORM\Id
	 * @ORM\Column(type="integer", length=12)
	 */
	protected $id;
	
	/**
	 * @ORM\ManyToOne(targetEntity="ItemBundle\Entity\Item", inversedBy="root_item")
     * @ORM\JoinColumn(name="root_item_id", referencedColumnName="id")
	 */
	protected $root_item_id;
	
	/**
	 * @ORM\OneToMany(targetEntity="ItemBundle\Entity\Item", mappedBy="root_item_id")
	 */
	protected $root_item;
	
	/**
	 * @ORM\ManyToOne(targetEntity="ItemBundle\Entity\Item", inversedBy="parent_item")
     * @ORM\JoinColumn(name="child_item_id", referencedColumnName="id")
	 */
	protected $child_item_id;
	
	/**
	 * @ORM\OneToMany(targetEntity="ItemBundle\Entity\Item", mappedBy="child_item_id")
	 */
	protected $parent_item;
	 
	/**
	 * @Assert\NotBlank()
	 * @ORM\Column(type="string", length=160)
	 */
	protected $name;
	 
	/**
	 * @Assert\NotBlank()
	 * @ORM\Column(type="string", length=255)
	 */
	protected $description;
	 
	/**
	 * @Assert\NotBlank()
	 * @ORM\Column(type="integer", length=2)
	 */
	protected $tier;
	 
	/**
	 * @Assert\NotBlank()
	 * @ORM\Column(type="integer", length=5)
	 */
	protected $price;
	 
	/**
	 * @Assert\NotBlank()
	 * @ORM\Column(type="string", length=64)
	 */
	protected $type;
	 
	/**
	 * @Assert\NotBlank()
	 * @ORM\Column(type="string", length=64)
	 */
	protected $short_description;
	
	/**
	 * @Assert\NotBlank()
	 * @ORM\Column(type="boolean")
	 */
	protected $starting_item;
	
	/**
	 * @Assert\NotBlank()
	 * @ORM\Column(type="integer", length=12)
	 */
	protected $icon_id;
	
	/**
	 * @var integer
	 * @ORM\OneToMany(targetEntity="ItemBundle\Entity\ItemDescriptor", mappedBy="item_id")
	 */
	protected $item_descriptor;
	 
	/**
	 * @Assert\NotBlank()
	 * @ORM\Column(type="string", length=160)
	 */
	protected $item_icon_URL;

    /**
     * Set id
     *
     * @param integer $id
     * @return Item
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
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
     * @return Item
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
     * @param string $description
     * @return Item
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set tier
     *
     * @param integer $tier
     * @return Item
     */
    public function setTier($tier)
    {
        $this->tier = $tier;

        return $this;
    }

    /**
     * Get tier
     *
     * @return integer 
     */
    public function getTier()
    {
        return $this->tier;
    }

    /**
     * Set price
     *
     * @param integer $price
     * @return Item
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return integer 
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return Item
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set short_description
     *
     * @param string $shortDescription
     * @return Item
     */
    public function setShortDescription($shortDescription)
    {
        $this->short_description = $shortDescription;

        return $this;
    }

    /**
     * Get short_description
     *
     * @return string 
     */
    public function getShortDescription()
    {
        return $this->short_description;
    }

    /**
     * Set starting_item
     *
     * @param boolean $startingItem
     * @return Item
     */
    public function setStartingItem($startingItem)
    {
        $this->starting_item = $startingItem;

        return $this;
    }

    /**
     * Get starting_item
     *
     * @return boolean 
     */
    public function getStartingItem()
    {
        return $this->starting_item;
    }

    /**
     * Set icon_id
     *
     * @param integer $iconId
     * @return Item
     */
    public function setIconId($iconId)
    {
        $this->icon_id = $iconId;

        return $this;
    }

    /**
     * Get icon_id
     *
     * @return integer 
     */
    public function getIconId()
    {
        return $this->icon_id;
    }

    /**
     * Set item_icon_URL
     *
     * @param string $itemIconURL
     * @return Item
     */
    public function setItemIconURL($itemIconURL)
    {
        $this->item_icon_URL = $itemIconURL;

        return $this;
    }

    /**
     * Get item_icon_URL
     *
     * @return string 
     */
    public function getItemIconURL()
    {
        return $this->item_icon_URL;
    }

    /**
     * Set root_item_id
     *
     * @param \ItemBundle\Entity\Item $rootItemId
     * @return Item
     */
    public function setRootItemId(\ItemBundle\Entity\Item $rootItemId = null)
    {
        $this->root_item_id = $rootItemId;

        return $this;
    }

    /**
     * Get root_item_id
     *
     * @return \ItemBundle\Entity\Item 
     */
    public function getRootItemId()
    {
        return $this->root_item_id;
    }

    /**
     * Set child_item_id
     *
     * @param \ItemBundle\Entity\Item $childItemId
     * @return Item
     */
    public function setChildItemId(\ItemBundle\Entity\Item $childItemId = null)
    {
        $this->child_item_id = $childItemId;

        return $this;
    }

    /**
     * Get child_item_id
     *
     * @return \ItemBundle\Entity\Item 
     */
    public function getChildItemId()
    {
        return $this->child_item_id;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->item_descriptor = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add item_descriptor
     *
     * @param \ItemBundle\Entity\ItemDescriptor $itemDescriptor
     * @return Item
     */
    public function addItemDescriptor(\ItemBundle\Entity\ItemDescriptor $itemDescriptor)
    {
        $this->item_descriptor[] = $itemDescriptor;

        return $this;
    }

    /**
     * Remove item_descriptor
     *
     * @param \ItemBundle\Entity\ItemDescriptor $itemDescriptor
     */
    public function removeItemDescriptor(\ItemBundle\Entity\ItemDescriptor $itemDescriptor)
    {
        $this->item_descriptor->removeElement($itemDescriptor);
    }

    /**
     * Get item_descriptor
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getItemDescriptor()
    {
        return $this->item_descriptor;
    }

    /**
     * Add root_item
     *
     * @param \ItemBundle\Entity\Item $rootItem
     * @return Item
     */
    public function addRootItem(\ItemBundle\Entity\Item $rootItem)
    {
        $this->root_item[] = $rootItem;

        return $this;
    }

    /**
     * Remove root_item
     *
     * @param \ItemBundle\Entity\Item $rootItem
     */
    public function removeRootItem(\ItemBundle\Entity\Item $rootItem)
    {
        $this->root_item->removeElement($rootItem);
    }

    /**
     * Get root_item
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRootItem()
    {
        return $this->root_item;
    }

    /**
     * Add parent_item
     *
     * @param \ItemBundle\Entity\Item $parentItem
     * @return Item
     */
    public function addParentItem(\ItemBundle\Entity\Item $parentItem)
    {
        $this->parent_item[] = $parentItem;

        return $this;
    }

    /**
     * Remove parent_item
     *
     * @param \ItemBundle\Entity\Item $parentItem
     */
    public function removeParentItem(\ItemBundle\Entity\Item $parentItem)
    {
        $this->parent_item->removeElement($parentItem);
    }

    /**
     * Get parent_item
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getParentItem()
    {
        return $this->parent_item;
    }
}

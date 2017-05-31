<?php

namespace ItemBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table[name="item_descriptor"]
 * @ORM\Entity
 */
class ItemDescriptor
{
	/**
	 * @ORM\Id
	 * @ORM\ManyToOne(targetEntity="ItemBundle\Entity\Item", inversedBy="item_descriptor")
     * @ORM\JoinColumn(name="item_id", referencedColumnName="id")
	 */
	protected $item_id;
	
	/**
	 * @ORM\Id
	 * @ORM\Column(type="string", length=64)
	 */
	protected $description;
	
	/**
	 * @ORM\Column(type="string", length=32)
	 */
	protected $value;

    /**
     * Set description
     *
     * @param string $description
     * @return ItemDescriptor
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
     * Set value
     *
     * @param string $value
     * @return ItemDescriptor
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return string 
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set item_id
     *
     * @param \ItemBundle\Entity\Item $itemId
     * @return ItemDescriptor
     */
    public function setItemId(\ItemBundle\Entity\Item $itemId)
    {
        $this->item_id = $itemId;

        return $this;
    }

    /**
     * Get item_id
     *
     * @return \ItemBundle\Entity\Item 
     */
    public function getItemId()
    {
        return $this->item_id;
    }
}

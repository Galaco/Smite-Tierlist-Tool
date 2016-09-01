<?php

namespace GodBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table[name="tier_list_god"]
 * @ORM\Entity
 */
class TierListGod
{
	/**
	 * @ORM\Id
	 * @ORM\Column(type="string", length=24)
	 */
	protected $uuid;
	 
	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 */
	protected $god_id;
	  
	/**
	 * @ORM\Column(type="datetime", length=24)
	 */
	protected $date_added;
	
	/**
	 * @Assert\NotBlank()
	 * @ORM\Column(type="integer")
	 */
	protected $tier_level;

    /**
     * Set date_added
     *
     * @param \DateTime $dateAdded
     * @return TierListGod
     */
    public function setDateAdded($dateAdded)
    {
        $this->date_added = $dateAdded;

        return $this;
    }

    /**
     * Get date_added
     *
     * @return \DateTime 
     */
    public function getDateAdded()
    {
        return $this->date_added;
    }

    /**
     * Set tier_level
     *
     * @param integer $tierLevel
     * @return TierListGod
     */
    public function setTierLevel($tierLevel)
    {
        $this->tier_level = $tierLevel;

        return $this;
    }

    /**
     * Get tier_level
     *
     * @return integer 
     */
    public function getTierLevel()
    {
        return $this->tier_level;
    }

    /**
     * Set uuid
     *
     * @param string $uuid
     * @return TierListGod
     */
    public function setUuid($uuid)
    {
        $this->uuid = $uuid;

        return $this;
    }

    /**
     * Get user_id
     *
     * @return \AppBundle\Entity\User 
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * Set god_id
     *
     * @param integer
     * @return TierListGod
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
}

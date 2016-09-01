<?php

namespace GodBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table[name="god_ability"]
 * @ORM\Entity
 */
class GodAbility
{
	/**
	 * @Assert\NotBlank()
	 * @ORM\Id
	 * @ORM\Column(type="string", length=12)
	 */
	protected $id;
	 
	/**
	 * @Assert\NotBlank()
	 * @ORM\Column(type="string", length=64)
	 */
	protected $summary;
	 
	/**
	 * @Assert\NotBlank()
	 * @ORM\Column(type="string", length=160)
	 */
	protected $url;
	 
	/**
	 * @Assert\NotBlank()
	 * @ORM\Column(type="text", length=512)
	 */
	protected $description;
	 
	/**
	 * @Assert\NotBlank()
	 * @ORM\Column(type="string", length=32)
	 */
	protected $cooldown;
	 
	/**
	 * @Assert\NotBlank()
	 * @ORM\Column(type="string", length=32)
	 */
	protected $cost;

    /**
     * Set id
     *
     * @param string $id
     * @return GodAbility
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get id
     *
     * @return string 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set summary
     *
     * @param string $summary
     * @return GodAbility
     */
    public function setSummary($summary)
    {
        $this->summary = $summary;

        return $this;
    }

    /**
     * Get summary
     *
     * @return string 
     */
    public function getSummary()
    {
        return $this->summary;
    }

    /**
     * Set url
     *
     * @param string $url
     * @return GodAbility
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string 
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return GodAbility
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
     * Set cooldown
     *
     * @param string $cooldown
     * @return GodAbility
     */
    public function setCooldown($cooldown)
    {
        $this->cooldown = $cooldown;

        return $this;
    }

    /**
     * Get cooldown
     *
     * @return string 
     */
    public function getCooldown()
    {
        return $this->cooldown;
    }

    /**
     * Set cost
     *
     * @param string $cost
     * @return GodAbility
     */
    public function setCost($cost)
    {
        $this->cost = $cost;

        return $this;
    }

    /**
     * Get cost
     *
     * @return string 
     */
    public function getCost()
    {
        return $this->cost;
    }
}

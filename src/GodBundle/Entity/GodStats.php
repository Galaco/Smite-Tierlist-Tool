<?php

namespace GodBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table[name="god_stats"]
 * @ORM\Entity
 */
class GodStats
{
	/**
	 * @Assert\NotBlank()
	 * @ORM\Id
	 * @ORM\Column(type="string", length=12)
	 */
	protected $id;
	 
	/**
	 * @Assert\NotBlank()
	 * @ORM\Column(type="float", length=4)
	 */
	protected $attack_speed;
	 
	/**
	 * @Assert\NotBlank()
	 * @ORM\Column(type="float", length=6)
	 */
	protected $attack_speed_per_level;
	 
	/**
	 * @ORM\Column(type="string", length=32)
	 */
	protected $cons;
	 
	/**
	 * @Assert\NotBlank()
	 * @ORM\Column(type="float", length=6)
	 */
	protected $HP5_per_level;
	 
	/**
	 * @Assert\NotBlank()
	 * @ORM\Column(type="float", length=4)
	 */
	protected $health;
	 
	/**
	 * @Assert\NotBlank()
	 * @ORM\Column(type="float", length=4)
	 */
	protected $health_per_five;
	 
	/**
	 * @Assert\NotBlank()
	 * @ORM\Column(type="float", length=4)
	 */
	protected $health_per_level;
	 
	/**
	 * @Assert\NotBlank()
	 * @ORM\Column(type="float", length=6)
	 */
	protected $mp5_per_level;
	 
	/**
	 * @Assert\NotBlank()
	 * @ORM\Column(type="float", length=4)
	 */
	protected $magic_protection;
	
	/**
	 * @Assert\NotBlank()
	 * @ORM\Column(type="float", length=4)
	 */
	protected $magic_protection_per_level;
	
	/**
	 * @Assert\NotBlank()
	 * @ORM\Column(type="float", length=4)
	 */
	protected $magical_power;
	 
	/**
	 * @Assert\NotBlank()
	 * @ORM\Column(type="float", length=4)
	 */
	protected $magical_power_per_level;
	 
	/**
	 * @Assert\NotBlank()
	 * @ORM\Column(type="integer", length=4)
	 */
	protected $mana;
	 
	/**
	 * @Assert\NotBlank()
	 * @ORM\Column(type="float", length=4)
	 */
	protected $mana_per_5;
	 
	/**
	 * @Assert\NotBlank()
	 * @ORM\Column(type="float", length=4)
	 */
	protected $mana_per_level;
	 
	/**
	 * @Assert\NotBlank()
	 * @ORM\Column(type="float", length=4)
	 */
	protected $physical_power;
	 
	/**
	 * @Assert\NotBlank()
	 * @ORM\Column(type="float", length=4)
	 */
	protected $physical_power_per_level;
	 
	/**
	 * @Assert\NotBlank()
	 * @ORM\Column(type="integer", length=4)
	 */
	protected $physical_protection;
	 
	/**
	 * @Assert\NotBlank()
	 * @ORM\Column(type="float", length=4)
	 */
	protected $physical_protection_per_level;
	 
	/**
	 * @Assert\NotBlank()
	 * @ORM\Column(type="float", length=4)
	 */
	protected $speed;

    /**
     * Set attack_speed
     *
     * @param float $attackSpeed
     * @return GodStats
     */
    public function setAttackSpeed($attackSpeed)
    {
        $this->attack_speed = $attackSpeed;

        return $this;
    }

    /**
     * Get attack_speed
     *
     * @return float 
     */
    public function getAttackSpeed()
    {
        return $this->attack_speed;
    }

    /**
     * Set attack_speed_per_level
     *
     * @param float $attackSpeedPerLevel
     * @return GodStats
     */
    public function setAttackSpeedPerLevel($attackSpeedPerLevel)
    {
        $this->attack_speed_per_level = $attackSpeedPerLevel;

        return $this;
    }

    /**
     * Get attack_speed_per_level
     *
     * @return float 
     */
    public function getAttackSpeedPerLevel()
    {
        return $this->attack_speed_per_level;
    }

    /**
     * Set cons
     *
     * @param string $cons
     * @return GodStats
     */
    public function setCons($cons)
    {
        $this->cons = $cons;

        return $this;
    }

    /**
     * Get cons
     *
     * @return string 
     */
    public function getCons()
    {
        return $this->cons;
    }

    /**
     * Set HP5_per_level
     *
     * @param float $hP5PerLevel
     * @return GodStats
     */
    public function setHP5PerLevel($hP5PerLevel)
    {
        $this->HP5_per_level = $hP5PerLevel;

        return $this;
    }

    /**
     * Get HP5_per_level
     *
     * @return float 
     */
    public function getHP5PerLevel()
    {
        return $this->HP5_per_level;
    }

    /**
     * Set health
     *
     * @param float $health
     * @return GodStats
     */
    public function setHealth($health)
    {
        $this->health = $health;

        return $this;
    }

    /**
     * Get health
     *
     * @return float 
     */
    public function getHealth()
    {
        return $this->health;
    }

    /**
     * Set health_per_five
     *
     * @param float $healthPerFive
     * @return GodStats
     */
    public function setHealthPerFive($healthPerFive)
    {
        $this->health_per_five = $healthPerFive;

        return $this;
    }

    /**
     * Get health_per_five
     *
     * @return float 
     */
    public function getHealthPerFive()
    {
        return $this->health_per_five;
    }

    /**
     * Set health_per_level
     *
     * @param float $healthPerLevel
     * @return GodStats
     */
    public function setHealthPerLevel($healthPerLevel)
    {
        $this->health_per_level = $healthPerLevel;

        return $this;
    }

    /**
     * Get health_per_level
     *
     * @return float 
     */
    public function getHealthPerLevel()
    {
        return $this->health_per_level;
    }

    /**
     * Set mp5_per_level
     *
     * @param float $mp5PerLevel
     * @return GodStats
     */
    public function setMp5PerLevel($mp5PerLevel)
    {
        $this->mp5_per_level = $mp5PerLevel;

        return $this;
    }

    /**
     * Get mp5_per_level
     *
     * @return float 
     */
    public function getMp5PerLevel()
    {
        return $this->mp5_per_level;
    }

    /**
     * Set magic_protection
     *
     * @param float $magicProtection
     * @return GodStats
     */
    public function setMagicProtection($magicProtection)
    {
        $this->magic_protection = $magicProtection;

        return $this;
    }

    /**
     * Get magic_protection
     *
     * @return float 
     */
    public function getMagicProtection()
    {
        return $this->magic_protection;
    }

    /**
     * Set magic_protection_per_level
     *
     * @param float $magicProtectionPerLevel
     * @return GodStats
     */
    public function setMagicProtectionPerLevel($magicProtectionPerLevel)
    {
        $this->magic_protection_per_level = $magicProtectionPerLevel;

        return $this;
    }

    /**
     * Get magic_protection_per_level
     *
     * @return float 
     */
    public function getMagicProtectionPerLevel()
    {
        return $this->magic_protection_per_level;
    }

    /**
     * Set magical_power
     *
     * @param float $magicalPower
     * @return GodStats
     */
    public function setMagicalPower($magicalPower)
    {
        $this->magical_power = $magicalPower;

        return $this;
    }

    /**
     * Get magical_power
     *
     * @return float 
     */
    public function getMagicalPower()
    {
        return $this->magical_power;
    }

    /**
     * Set magical_power_per_level
     *
     * @param float $magicalPowerPerLevel
     * @return GodStats
     */
    public function setMagicalPowerPerLevel($magicalPowerPerLevel)
    {
        $this->magical_power_per_level = $magicalPowerPerLevel;

        return $this;
    }

    /**
     * Get magical_power_per_level
     *
     * @return float 
     */
    public function getMagicalPowerPerLevel()
    {
        return $this->magical_power_per_level;
    }

    /**
     * Set mana
     *
     * @param integer $mana
     * @return GodStats
     */
    public function setMana($mana)
    {
        $this->mana = $mana;

        return $this;
    }

    /**
     * Get mana
     *
     * @return integer 
     */
    public function getMana()
    {
        return $this->mana;
    }

    /**
     * Set mana_per_5
     *
     * @param float $manaPer5
     * @return GodStats
     */
    public function setManaPer5($manaPer5)
    {
        $this->mana_per_5 = $manaPer5;

        return $this;
    }

    /**
     * Get mana_per_5
     *
     * @return float 
     */
    public function getManaPer5()
    {
        return $this->mana_per_5;
    }

    /**
     * Set mana_per_level
     *
     * @param float $manaPerLevel
     * @return GodStats
     */
    public function setManaPerLevel($manaPerLevel)
    {
        $this->mana_per_level = $manaPerLevel;

        return $this;
    }

    /**
     * Get mana_per_level
     *
     * @return float 
     */
    public function getManaPerLevel()
    {
        return $this->mana_per_level;
    }

    /**
     * Set physical_power
     *
     * @param float $physicalPower
     * @return GodStats
     */
    public function setPhysicalPower($physicalPower)
    {
        $this->physical_power = $physicalPower;

        return $this;
    }

    /**
     * Get physical_power
     *
     * @return float 
     */
    public function getPhysicalPower()
    {
        return $this->physical_power;
    }

    /**
     * Set physical_power_per_level
     *
     * @param float $physicalPowerPerLevel
     * @return GodStats
     */
    public function setPhysicalPowerPerLevel($physicalPowerPerLevel)
    {
        $this->physical_power_per_level = $physicalPowerPerLevel;

        return $this;
    }

    /**
     * Get physical_power_per_level
     *
     * @return float 
     */
    public function getPhysicalPowerPerLevel()
    {
        return $this->physical_power_per_level;
    }

    /**
     * Set physical_protection
     *
     * @param integer $physicalProtection
     * @return GodStats
     */
    public function setPhysicalProtection($physicalProtection)
    {
        $this->physical_protection = $physicalProtection;

        return $this;
    }

    /**
     * Get physical_protection
     *
     * @return integer
     */
    public function getPhysicalProtection()
    {
        return $this->physical_protection;
    }

    /**
     * Set physical_protection_per_level
     *
     * @param float $physicalProtectionPerLevel
     * @return GodStats
     */
    public function setPhysicalProtectionPerLevel($physicalProtectionPerLevel)
    {
        $this->physical_protection_per_level = $physicalProtectionPerLevel;

        return $this;
    }

    /**
     * Get physical_protection_per_level
     *
     * @return float 
     */
    public function getPhysicalProtectionPerLevel()
    {
        return $this->physical_protection_per_level;
    }

    /**
     * Set speed
     *
     * @param float $speed
     * @return GodStats
     */
    public function setSpeed($speed)
    {
        $this->speed = $speed;

        return $this;
    }

    /**
     * Get speed
     *
     * @return float 
     */
    public function getSpeed()
    {
        return $this->speed;
    }

    /**
     * Set id
     *
     * @param string
     * @return GodStats
     */
    public function setGodId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get id
     *
     * @return \GodBundle\Entity\God 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set id
     *
     * @param string $id
     * @return GodStats
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}

<?php

namespace GodBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table[name="god"]
 * @ORM\Entity
 */
class God
{
	/**
	 * @Assert\NotBlank()
	 * @ORM\Id
	 * @ORM\Column(type="string", length=12)
	 */
	protected $id;
	 
	/**
	 * @Assert\NotBlank()
	 * @ORM\Column(type="string", length=24)
	 */
	protected $name;
	 
	/**
	 * @Assert\NotBlank()
	 * @ORM\Column(type="string", length=64)
	 */
	protected $title;
	 
	/**
	 * @Assert\NotBlank()
	 * @ORM\Column(type="string", length=24)
	 */
	protected $role;
	 
	/**
	 * @Assert\NotBlank()
	 * @ORM\Column(type="string", length=64)
	 */
	protected $pantheon;
	 
	/**
	 * @Assert\NotBlank()
	 * @ORM\Column(type="string", length=64)
	 */
	protected $type;
	 
	/**
	 * @Assert\NotBlank()
	 * @ORM\Column(type="text", length=2048)
	 */
	protected $lore;
	 
	/**
	 * @Assert\NotBlank()
	 * @ORM\Column(type="string", length=160)
	 */
	protected $god_card_url;
	 
	/**
	 * @Assert\NotBlank()
	 * @ORM\Column(type="string", length=160)
	 */
	protected $god_icon_url;
	 
	/**
	 * @Assert\NotBlank()
	 * @ORM\Column(type="string", length=64)
	 */
	protected $pros;
	 
	/**
     * @ORM\OneToOne(targetEntity="GodBundle\Entity\GodAbility")
     * @ORM\JoinColumn(name="ability_id_1", referencedColumnName="id")
	 */
	protected $ability_id_1;
	 
	/**
     * @ORM\OneToOne(targetEntity="GodBundle\Entity\GodAbility")
     * @ORM\JoinColumn(name="ability_id_2", referencedColumnName="id")
	 */
	protected $ability_id_2;
	 
	/**
     * @ORM\OneToOne(targetEntity="GodBundle\Entity\GodAbility")
     * @ORM\JoinColumn(name="ability_id_3", referencedColumnName="id")
	 */
	protected $ability_id_3;
	 
	/**
     * @ORM\OneToOne(targetEntity="GodBundle\Entity\GodAbility")
     * @ORM\JoinColumn(name="ability_id_4", referencedColumnName="id")
	 */
	protected $ability_id_4;
	 
	/**
     * @ORM\OneToOne(targetEntity="GodBundle\Entity\GodAbility")
     * @ORM\JoinColumn(name="ability_id_5", referencedColumnName="id")
	 */
	protected $ability_id_5;
	
	/**
     * @ORM\OneToOne(targetEntity="GodBundle\Entity\GodStats")
     * @ORM\JoinColumn(name="id", referencedColumnName="id")
	 */
	protected $god_stats_id;

    /**
     * Set id
     *
     * @param string $id
     * @return God
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
     * Set name
     *
     * @param string $name
     * @return God
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
     * Set title
     *
     * @param string $title
     * @return God
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set role
     *
     * @param string $role
     * @return God
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
     * Set pantheon
     *
     * @param string $pantheon
     * @return God
     */
    public function setPantheon($pantheon)
    {
        $this->pantheon = $pantheon;

        return $this;
    }

    /**
     * Get pantheon
     *
     * @return string 
     */
    public function getPantheon()
    {
        return $this->pantheon;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return God
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
     * Set lore
     *
     * @param string $lore
     * @return God
     */
    public function setLore($lore)
    {
        $this->lore = $lore;

        return $this;
    }

    /**
     * Get lore
     *
     * @return string 
     */
    public function getLore()
    {
        return $this->lore;
    }

    /**
     * Set god_card_url
     *
     * @param string $godCardUrl
     * @return God
     */
    public function setGodCardUrl($godCardUrl)
    {
        $this->god_card_url = $godCardUrl;

        return $this;
    }

    /**
     * Get god_card_url
     *
     * @return string 
     */
    public function getGodCardUrl()
    {
        return $this->god_card_url;
    }

    /**
     * Set god_icon_url
     *
     * @param string $godIconUrl
     * @return God
     */
    public function setGodIconUrl($godIconUrl)
    {
        $this->god_icon_url = $godIconUrl;

        return $this;
    }

    /**
     * Get god_icon_url
     *
     * @return string 
     */
    public function getGodIconUrl()
    {
        return $this->god_icon_url;
    }

    /**
     * Set pros
     *
     * @param string $pros
     * @return God
     */
    public function setPros($pros)
    {
        $this->pros = $pros;

        return $this;
    }

    /**
     * Get pros
     *
     * @return string 
     */
    public function getPros()
    {
        return $this->pros;
    }

    /**
     * Set ability_id_1
     *
     * @param integer $abilityId1
     * @return God
     */
    public function setAbilityId1($abilityId1)
    {
        $this->ability_id_1 = $abilityId1;

        return $this;
    }

    /**
     * Get ability_id_1
     *
     * @return integer 
     */
    public function getAbilityId1()
    {
        return $this->ability_id_1;
    }

    /**
     * Set ability_id_2
     *
     * @param integer $abilityId2
     * @return God
     */
    public function setAbilityId2($abilityId2)
    {
        $this->ability_id_2 = $abilityId2;

        return $this;
    }

    /**
     * Get ability_id_2
     *
     * @return integer 
     */
    public function getAbilityId2()
    {
        return $this->ability_id_2;
    }

    /**
     * Set ability_id_3
     *
     * @param integer $abilityId3
     * @return God
     */
    public function setAbilityId3($abilityId3)
    {
        $this->ability_id_3 = $abilityId3;

        return $this;
    }

    /**
     * Get ability_id_3
     *
     * @return integer 
     */
    public function getAbilityId3()
    {
        return $this->ability_id_3;
    }

    /**
     * Set ability_id_4
     *
     * @param integer $abilityId4
     * @return God
     */
    public function setAbilityId4($abilityId4)
    {
        $this->ability_id_4 = $abilityId4;

        return $this;
    }

    /**
     * Get ability_id_4
     *
     * @return integer 
     */
    public function getAbilityId4()
    {
        return $this->ability_id_4;
    }

    /**
     * Set ability_id_5
     *
     * @param integer $abilityId5
     * @return God
     */
    public function setAbilityId5($abilityId5)
    {
        $this->ability_id_5 = $abilityId5;

        return $this;
    }

    /**
     * Get ability_id_5
     *
     * @return integer 
     */
    public function getAbilityId5()
    {
        return $this->ability_id_5;
    }

    /**
     * Set god_stats_id
     *
     * @param string $godStatsId
     * @return God
     */
    public function setGodStatsId($godStatsId)
    {
        $this->god_stats_id = $godStatsId;

        return $this;
    }

    /**
     * Get god_stats_id
     *
     * @return string 
     */
    public function getGodStatsId()
    {
        return $this->god_stats_id;
    }
}

<?php

namespace PlayerBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table[name="player"]
 * @ORM\Entity
 */
class Player
{
	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 */
	protected $id;
	 
	/**
	 * @ORM\Column(type="string")
	 */
	protected $username;
	  
	/**
	 * @ORM\Column(type="string")
	 */
	protected $avatar_url;
	
	/**
	 * @ORM\Column(type="string")
	 */
	protected $date_created;
	
	/**
	 * @ORM\Column(type="string")
	 */
	protected $date_last_login;
	
	/**
	 * @ORM\Column(type="integer")
	 */
	protected $leaves;
	
	/**
	 * @ORM\Column(type="integer")
	 */
	protected $level;
	
	/**
	 * @ORM\Column(type="integer")
	 */
	protected $wins;
	
	/**
	 * @ORM\Column(type="integer")
	 */
	protected $losses;
	
	/**
	 * @ORM\Column(type="integer")
	 */
	protected $masteryLevel;
	
	/**
	 * @ORM\Column(type="integer")
	 */
	protected $tier_conquest;
	
	/**
	 * @ORM\Column(type="integer")
	 */
	protected $tier_joust;
	
	/**
	 * @ORM\Column(type="integer")
	 */
	protected $total_achievements;
	
	/**
	 * @ORM\Column(type="integer")
	 */
	protected $total_worshippers;

    /**
     * Set id
     *
     * @param integer $id
     * @return Player
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
     * Set username
     *
     * @param string $username
     * @return Player
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string 
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set avatar_url
     *
     * @param string $avatarUrl
     * @return Player
     */
    public function setAvatarUrl($avatarUrl)
    {
        $this->avatar_url = $avatarUrl;

        return $this;
    }

    /**
     * Get avatar_url
     *
     * @return string 
     */
    public function getAvatarUrl()
    {
        return $this->avatar_url;
    }

    /**
     * Set date_created
     *
     * @param string $dateCreated
     * @return Player
     */
    public function setDateCreated($dateCreated)
    {
        $this->date_created = $dateCreated;

        return $this;
    }

    /**
     * Get date_created
     *
     * @return string 
     */
    public function getDateCreated()
    {
        return $this->date_created;
    }

    /**
     * Set date_last_login
     *
     * @param string $dateLastLogin
     * @return Player
     */
    public function setDateLastLogin($dateLastLogin)
    {
        $this->date_last_login = $dateLastLogin;

        return $this;
    }

    /**
     * Get date_last_login
     *
     * @return string 
     */
    public function getDateLastLogin()
    {
        return $this->date_last_login;
    }

    /**
     * Set leaves
     *
     * @param integer $leaves
     * @return Player
     */
    public function setLeaves($leaves)
    {
        $this->leaves = $leaves;

        return $this;
    }

    /**
     * Get leaves
     *
     * @return integer 
     */
    public function getLeaves()
    {
        return $this->leaves;
    }

    /**
     * Set level
     *
     * @param integer $level
     * @return Player
     */
    public function setLevel($level)
    {
        $this->level = $level;

        return $this;
    }

    /**
     * Get level
     *
     * @return integer 
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * Set wins
     *
     * @param integer $wins
     * @return Player
     */
    public function setWins($wins)
    {
        $this->wins = $wins;

        return $this;
    }

    /**
     * Get wins
     *
     * @return integer 
     */
    public function getWins()
    {
        return $this->wins;
    }

    /**
     * Set losses
     *
     * @param integer $losses
     * @return Player
     */
    public function setLosses($losses)
    {
        $this->losses = $losses;

        return $this;
    }

    /**
     * Get losses
     *
     * @return integer 
     */
    public function getLosses()
    {
        return $this->losses;
    }

    /**
     * Set masteryLevel
     *
     * @param integer $masteryLevel
     * @return Player
     */
    public function setMasteryLevel($masteryLevel)
    {
        $this->masteryLevel = $masteryLevel;

        return $this;
    }

    /**
     * Get masteryLevel
     *
     * @return integer 
     */
    public function getMasteryLevel()
    {
        return $this->masteryLevel;
    }

    /**
     * Set tier_conquest
     *
     * @param integer $tierConquest
     * @return Player
     */
    public function setTierConquest($tierConquest)
    {
        $this->tier_conquest = $tierConquest;

        return $this;
    }

    /**
     * Get tier_conquest
     *
     * @return integer 
     */
    public function getTierConquest()
    {
        return $this->tier_conquest;
    }

    /**
     * Set tier_joust
     *
     * @param integer $tierJoust
     * @return Player
     */
    public function setTierJoust($tierJoust)
    {
        $this->tier_joust = $tierJoust;

        return $this;
    }

    /**
     * Get tier_joust
     *
     * @return integer 
     */
    public function getTierJoust()
    {
        return $this->tier_joust;
    }

    /**
     * Set total_achievements
     *
     * @param integer $totalAchievements
     * @return Player
     */
    public function setTotalAchievements($totalAchievements)
    {
        $this->total_achievements = $totalAchievements;

        return $this;
    }

    /**
     * Get total_achievements
     *
     * @return integer 
     */
    public function getTotalAchievements()
    {
        return $this->total_achievements;
    }

    /**
     * Set total_worshippers
     *
     * @param integer $totalWorshippers
     * @return Player
     */
    public function setTotalWorshippers($totalWorshippers)
    {
        $this->total_worshippers = $totalWorshippers;

        return $this;
    }

    /**
     * Get total_worshippers
     *
     * @return integer 
     */
    public function getTotalWorshippers()
    {
        return $this->total_worshippers;
    }
}

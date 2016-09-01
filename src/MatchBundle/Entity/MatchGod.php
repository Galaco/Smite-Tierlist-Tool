<?php
// src/MatchBundle/Entity/MatchGod.php

namespace MatchBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="match_god")
 */
class MatchGod
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    protected $match_id;
	
	/**
     * @ORM\Id
     * @ORM\Column(type="integer")
	 */
	protected $player_id;
	
	/**
     * @ORM\Column(type="integer")
	 */
	protected $god_id;
	
	/**
     * @ORM\Column(type="integer")
	 */
	protected $item_1;
	
	/**
     * @ORM\Column(type="integer")
	 */
	protected $item_2;
	
	/**
     * @ORM\Column(type="integer")
	 */
	protected $item_3;
	
	/**
     * @ORM\Column(type="integer")
	 */
	protected $item_4;
	
	/**
     * @ORM\Column(type="integer")
	 */
	protected $item_5;
	
	/**
     * @ORM\Column(type="integer")
	 */
	protected $item_6;
	
	/**
     * @ORM\Column(type="integer")
	 */
	protected $gold_earned;

    /**
     * Set match_id
     *
     * @param integer $matchId
     * @return MatchGod
     */
    public function setMatchId($matchId)
    {
        $this->match_id = $matchId;

        return $this;
    }

    /**
     * Get match_id
     *
     * @return integer 
     */
    public function getMatchId()
    {
        return $this->match_id;
    }

    /**
     * Set player_id
     *
     * @param integer $playerId
     * @return MatchGod
     */
    public function setPlayerId($playerId)
    {
        $this->player_id = $playerId;

        return $this;
    }

    /**
     * Get player_id
     *
     * @return integer 
     */
    public function getPlayerId()
    {
        return $this->player_id;
    }

    /**
     * Set god_id
     *
     * @param integer $godId
     * @return MatchGod
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
     * Set item_1
     *
     * @param integer $item1
     * @return MatchGod
     */
    public function setItem1($item1)
    {
        $this->item_1 = $item1;

        return $this;
    }

    /**
     * Get item_1
     *
     * @return integer 
     */
    public function getItem1()
    {
        return $this->item_1;
    }

    /**
     * Set item_2
     *
     * @param integer $item2
     * @return MatchGod
     */
    public function setItem2($item2)
    {
        $this->item_2 = $item2;

        return $this;
    }

    /**
     * Get item_2
     *
     * @return integer 
     */
    public function getItem2()
    {
        return $this->item_2;
    }

    /**
     * Set item_3
     *
     * @param integer $item3
     * @return MatchGod
     */
    public function setItem3($item3)
    {
        $this->item_3 = $item3;

        return $this;
    }

    /**
     * Get item_3
     *
     * @return integer 
     */
    public function getItem3()
    {
        return $this->item_3;
    }

    /**
     * Set item_4
     *
     * @param integer $item4
     * @return MatchGod
     */
    public function setItem4($item4)
    {
        $this->item_4 = $item4;

        return $this;
    }

    /**
     * Get item_4
     *
     * @return integer 
     */
    public function getItem4()
    {
        return $this->item_4;
    }

    /**
     * Set item_5
     *
     * @param integer $item5
     * @return MatchGod
     */
    public function setItem5($item5)
    {
        $this->item_5 = $item5;

        return $this;
    }

    /**
     * Get item_5
     *
     * @return integer 
     */
    public function getItem5()
    {
        return $this->item_5;
    }

    /**
     * Set item_6
     *
     * @param integer $item6
     * @return MatchGod
     */
    public function setItem6($item6)
    {
        $this->item_6 = $item6;

        return $this;
    }

    /**
     * Get item_6
     *
     * @return integer 
     */
    public function getItem6()
    {
        return $this->item_6;
    }

    /**
     * Set gold_earned
     *
     * @param integer $goldEarned
     * @return MatchGod
     */
    public function setGoldEarned($goldEarned)
    {
        $this->gold_earned = $goldEarned;

        return $this;
    }

    /**
     * Get gold_earned
     *
     * @return integer 
     */
    public function getGoldEarned()
    {
        return $this->gold_earned;
    }
}

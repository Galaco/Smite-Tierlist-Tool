<?php
// src/GameBundle/Entity/Game.php

namespace GameBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use TierBundle\Entity\Character;

/**
 * @ORM\Entity
 * @ORM\Table(name="game")
 */
class Game
{

    /**
     * @ORM\Id
     * @ORM\Column(type="text")
     */
	private $name;

    /**
     * @ORM\Column(type="text")
     */
	private $short_name;


    /**
     * @OneToMany(targetEntity="CharacterId", mappedBy="character", cascade={"ALL"}, indexBy="game")
     */
	private $characters;


	public function __construct($name)
    {
        $this->name = $name;
    }
	 

    /**
     * Set id
     *
     * @param string $id
     * @return Game
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
     * @return Game
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }


    /**
     * Get id
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }


    /**
     * Set short name
     *
     * @param string $name
     * @return Game
     */
    public function setShortName($name)
    {
        $this->short_name = $name;
        return $this;
    }


    /**
     * Get id
     *
     * @return string
     */
    public function getShortName()
    {
        return $this->short_name;
    }


    /**
     * Add a character to the game.
     *
     * @param $name
     */
    public function addCharacter($name)
    {
        $this->characters[$name] = new Character($name, $this->getId());
    }
}

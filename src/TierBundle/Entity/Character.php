<?php
// src/TierBundle/Entity/Character.php

namespace TierBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="character")
 */
class Character
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
	private $id;

    /**
     * @ORM\Id
     * @ManyToOne(targetEntity="Game", inversedBy="characters")
     */
	private $game;


    /**
     * @ORM\Column(type="text")
     */
	protected $name;


	public function __construct($name, $game)
    {
        $this->name = $name;
        $this->game = $this;
    }


    /**
     * Set id
     *
     * @param string $id
     * @return Character
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
}

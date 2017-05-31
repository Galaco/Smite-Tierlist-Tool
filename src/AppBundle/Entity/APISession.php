<?php
// src/AppBundle/Entity/APISession.php

namespace AppBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="api_session")
 */
class APISession
{
	/**
	 * @Assert\NotBlank()
	 * @ORM\Id
	 * @ORM\Column(type="string", length=32)
	 */
	protected $id;
	 
	/**
	 * @Assert\NotBlank()
	 * @ORM\Column(type="datetime", length=24)
	 */
	protected $timestamp;
	 

    /**
     * Set id
     *
     * @param string $id
     * @return APISession
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
     * Set timestamp
     *
     * @param \DateTime $timestamp
     * @return APISession
     */
    public function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;

        return $this;
    }

    /**
     * Get timestamp
     *
     * @return \DateTime 
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }
}

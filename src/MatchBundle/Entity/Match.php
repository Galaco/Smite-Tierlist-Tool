<?php
// src/MatchBundle/Entity/Match.php

namespace MatchBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="match_info")
 */
class Match
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    protected $id;
	
	 /**
     * @ORM\Column(type="integer")
     */
	protected $queue_id = 0;
	 
	/**
	 * @ORM\Column(type="datetime", length=24)
	 */
	protected $date_added;

    /**
     * Set id
     *
	 * @param integer $id
     * @return Match 
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
     * Set queue_id
     *
     * @param integer $queueId
     * @return Match
     */
    public function setQueueId($queueId)
    {
        $this->queue_id = $queueId;

        return $this;
    }

    /**
     * Get queue_id
     *
     * @return integer 
     */
    public function getQueueId()
    {
        return $this->queue_id;
    }

    /**
     * Set date_added
     *
     * @param \DateTime $date_added
     * @return APISession
     */
    public function setDateAdded($date_added)
    {
        $this->date_added = $date_added;

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
}

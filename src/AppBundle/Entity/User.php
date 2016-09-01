<?php
// src/AppBundle/Entity/User.php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
	
	/**
     * @ORM\Column(type="string")
     */
    private $linked_account_name;

    public function __construct()
    {
        parent::__construct();
        // your own logic
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
     * Get linked account name
     *
     * @return string 
     */
    public function getLinkedAccountName()
    {
        return $this->linked_account_name;
    }

    /**
     * Set linked account name
     *
     * @return \User 
     */
    public function setLinkedAccountName($linkedAccountName)
    {
        $this->linked_account_name = $linkedAccountName;
		return $this->linked_account_name;
    }
}

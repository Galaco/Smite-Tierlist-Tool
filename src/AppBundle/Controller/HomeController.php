<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Controller\AbstractController;


class HomeController extends AbstractController
{
    public function indexAction()
    {
        return $this->render('AppBundle:Index:index.html.twig', array(

		));
    }
	
	public function homeAction()
	{
		return $this->render('AppBundle:Home:index.html.twig', array(

		));
	}
}

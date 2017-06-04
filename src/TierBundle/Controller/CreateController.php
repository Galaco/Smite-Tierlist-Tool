<?php

namespace TierBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Controller\AbstractController;


class CreateController extends AbstractController
{
	public function IndexAction()
	{

		return $this->render('TierBundle::Create::index.html.twig', []);
	}
}

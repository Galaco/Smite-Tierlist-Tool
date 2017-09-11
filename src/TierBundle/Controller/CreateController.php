<?php

namespace TierBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Controller\AbstractController;


/**
 * Controller for tierlist creation and viewing
 * @package TierBundle\Controller
 */
class CreateController extends AbstractController
{

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
	public function IndexAction()
	{

		return $this->render('TierBundle::Create::index.html.twig', []);
	}
}

<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Controller\AbstractController;


/**
 * Main index page controller.
 *
 * @package AppBundle\Controller
 */
class HomeController extends AbstractController
{
    public function indexAction()
    {
        return $this->render('AppBundle:Index:index.html.twig', array(

		));
    }
}

<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Controller\DefaultController;


class HomeController extends DefaultController
{
    public function indexAction()
    {
        return $this->render('AppBundle:Index:index.html.twig', array(
			'searchForm' => $this->_searchHelper->getSearchForm()->createView()
		));
    }
	
	public function homeAction()
	{
		return $this->render('AppBundle:Home:index.html.twig', array(
			'searchForm' => $this->_searchHelper->getSearchForm()->createView()
		));
	}
	
	public function searchAction()
	{
		$searchForm = $this->_searchHelper->getSearchForm();
		if ($response = $this->_searchHelper->sendSearchForm($searchForm)) {
			return $response;
		}
		
		return $this->redirect($this->generateUrl('appbundle_home_index'));
	}
}

<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
	protected $_searchHelper;
	protected $_apiHelper;
	protected $_awsHelper;
     
    /**
     * Set your services here (we need to override this method to initialize our services into class properties)
     *
     * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
     */
    public function setContainer(\Symfony\Component\DependencyInjection\ContainerInterface $container = null)
    {
        parent::setContainer($container);
        $this->_searchHelper = $this->get('appbundle.util.searchhelper');
        $this->_apiHelper = $this->get('appbundle.util.apihelper');
        $this->_awsHelper = $this->get('appbundle.util.awshelper');
    }  
    /**
     * @Route("/app/example", name="homepage")
     */
    public function indexAction()
    {
        return $this->render('default/index.html.twig');
    }
}

<?php

namespace UserBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;

use FOS\UserBundle\Controller\SecurityController as BaseController;

class SecurityController extends BaseController
{
	protected $_searchHelper;

    /**
     * Renders the login template with the given parameters. Overwrite this function in
     * an extended controller to provide additional data for the login template.
     *
     * @param array $data
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function renderLogin(array $data)
    {
		$data['searchForm'] = $this->_searchHelper->getSearchForm()->createView();
        return $this->render('UserBundle:Security:login.html.twig', $data);
    }
     
    /**
     * Set your services here (we need to override this method to initialize our services into class properties)
     *
     * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
     */
    public function setContainer(\Symfony\Component\DependencyInjection\ContainerInterface $container = null)
    {
        parent::setContainer($container);
        $this->_searchHelper = $this->get('appbundle.util.searchhelper');
    }  
}

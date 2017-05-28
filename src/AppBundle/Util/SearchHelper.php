<?php
 
// src/AppBundle/Util/SearchHelper.php
 
namespace AppBundle\Util;
 
use AppBundle\Form\Type\SearchType;
use Symfony\Component\DependencyInjection\ContainerInterface as Container;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Bundle\FrameworkBundle\Routing\Router;

use Doctrine\ORM\EntityManager;
 
class SearchHelper
{
    private $_container;
    private $_router;
    private $_entityManager;
 
    // notice that we're injecting service-container to be able to get other symfony2 services
    public function __construct(
        Container $serviceContainer,
		Router $router,
		EntityManager $entityManager
    )
    {
        $this->_container = $serviceContainer;
        $this->_router = $router;
        $this->_entityManager = $entityManager;
    }
 
    public function getSearchForm()
    {
        $request = $this->_container->get('request');               
         
        $searchData = [];
        $searchType = new SearchType($this->_router);
        $searchForm = $this->_container->get('form.factory')->create($searchType, $searchData);
         
        $searchForm->handleRequest($request);
         
        return $searchForm;
    }
     
    /**
     * Sends email if form is valid
     * 
     * @return null|RedirectResponse
     */
    public function sendSearchForm($searchForm)
    {       
		$url = "/";
        if ($searchForm->isValid()) {
            $data = $searchForm->getData();            
 
			if($data['type'] == 'player') {
				$url = $this->_router->generate('playerbundle_player_player', ['_name' => $data['name']]);
			} elseif ($data['type'] == 'god') {
				$repository = $this->_entityManager
					->getRepository('GodBundle:God');
				$god = $repository->findOneByName($data['name']);
				if ($god) {
					$url = $this->_router->generate('godbundle_god_god', ['_id' => $god->getId()]);
				}			
			}
            return new RedirectResponse($url, 301);
        }
        return null;
    }
}
<?php
 
// src/AppBundle/Util/SearchHelper.php
 
namespace GodBundle\Util;
 
use GodBundle\Form\Type\TierlistType;
use Symfony\Component\DependencyInjection\ContainerInterface as Container;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Bundle\FrameworkBundle\Routing\Router;

use Doctrine\ORM\EntityManager;
 
class TierlistHelper
{
    private $_container;
 
    // notice that we're injecting service-container to be able to get other symfony2 services
    public function __construct(
        Container $serviceContainer
    )
    {
        $this->_container = $serviceContainer;
    }
 
    public function getForm($count)
    {
        $request = $this->_container->get('request');               
         
        $searchData = ['allow_extra_fields' => true];
        $searchType = new TierlistType($this->_container->get('router'), $count);
        $searchForm = $this->_container->get('form.factory')->create($searchType, $searchData);
         
        $searchForm->handleRequest($request);
         
        return $searchForm;
    }
     
    /**
     * Sends email if form is valid
     * 
     * @return bool
     */
    public function sendForm($searchForm)
    {
        if ($searchForm->isValid()) {
            $data = $searchForm->getData();

			foreach($data as $key => $value) {
				if (strpos($key, "tierlist_god_") != -1) {
					if (((int)$value >= -1 && (int)$value > 18) || $value == null)  {
						continue;
					}
				}
			}
			return true;
        }
        return false;
    }
}
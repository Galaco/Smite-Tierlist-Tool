<?php

namespace GodBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use AppBundle\Controller\DefaultController;

use GodBundle\Entity\God;
use GodBundle\Entity\TierListGod;

class TierlistController extends DefaultController
{	
	protected $_tierlistHelper;
     
    /**
     * Set your services here (we need to override this method to initialize our services into class properties)
     *
     * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
     */
    public function setContainer(\Symfony\Component\DependencyInjection\ContainerInterface $container = null)
    {
        parent::setContainer($container);
        $this->_tierlistHelper = $this->get('godbundle.util.tierlisthelper');
    }  
	
	
	public function indexAction()
	{
		
		$m = $this->getDoctrine()->getManager();
		$qb = $m->createQueryBuilder();
		
		$tierList = $qb->add('select', 'g.id, g.name, g.god_icon_url, tlg.tier_level, AVG(tlg.tier_level) AS magnitude')
			->from('GodBundle\Entity\God', 'g')
			->join('GodBundle\Entity\TierListGod', 'tlg')
			->where('g.id = tlg.god_id')
			->andWhere('tlg.tier_level != 14')
			->andWhere('tlg.tier_level != 0')
			->groupBy("g.id")
			->getQuery()
			->getResult();
			
		$responseData = [
			'tierList' => $tierList,
			'searchForm' => $this->_searchHelper->getSearchForm()->createView()
		];
		return $this->render('GodBundle:Tierlist:index.html.twig', $responseData);
	}
	
	public function newAction()
	{
		$m = $this->getDoctrine()->getManager();
			
		$qb = $m->createQueryBuilder();
		$godList = $qb->add('select', 'g.id, g.name, g.god_icon_url')
			->from('GodBundle\Entity\God', 'g')
			->getQuery()
			->getResult();
		
		$responseData = [
			'godList' => $godList,
			'searchForm' => $this->_searchHelper->getSearchForm()->createView(),
			'tierlistForm' => $this->_tierlistHelper->getForm($godList)->createView()
		];
		return $this->render('GodBundle:Tierlist:new.html.twig', $responseData);
	}
	
	public function saveAction()
	{
		$uuid = sprintf('%04x%04x-%04x%04x%04x',
			// 32 bits for "time_low"
			mt_rand(0, 0xffff), mt_rand(0, 0xffff),
			// 48 bits for "node"
			mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff));
			
		$m = $this->getDoctrine()->getManager();	
		$qb = $m->createQueryBuilder();
		$godList = $qb->add('select', 'g.id, g.name, g.god_icon_url')
			->from('GodBundle\Entity\God', 'g')
			->getQuery()
			->getResult();
		
		$form = $this->_tierlistHelper->getForm($godList);
		if ($response = $this->_tierlistHelper->sendForm($form)) {
			$gods = $form->getData();
			
			$datetime = new \DateTime('now', new \DateTimeZone("UTC"));
				
			foreach($gods as $key => $value) {
				$value = (int)$value;
				if (strpos($key, 'tierlist_god_') != -1 && $value >=0 && $value <= 18) {
					try {
						$id = (int)substr($key, -4);
								
						$tierGod = new TierListGod;
						$tierGod->setUuid($uuid)
							->setGodId($id)
							->setDateAdded($datetime)
							->setTierLevel($value);
									
						$m->merge($tierGod);
					} catch (\Exception $e) { 
						
					}
				} 				
			}
			$m->flush();
			return $this->redirect($this->generateUrl('godbundle_tierlist_list', ['_unique' => $uuid]));	
		}
		return $this->redirect($this->generateUrl('godbundle_tierlist_index'));	
		
	}
	
	public function listAction($_unique = -1)
	{
		if ($_unique == -1) {
			return $this->redirect($this->generateUrl('godbundle_tierlist_index'));
		}
		
		$em = $this->getDoctrine()->getManager();	
			
		//Users own saved tierlist
		$qb = $em->createQueryBuilder();
		$userTier = $qb->add('select', 'tlg.tier_level, g.id, g.name, g.god_icon_url')
			->from('GodBundle\Entity\TierListGod', 'tlg')
			->join('GodBundle\Entity\God', 'g')
			->where('tlg.god_id = g.id')
			->andWhere('tlg.uuid = :uuid')
			->setParameter('uuid', $_unique)
			->getQuery()
			->getResult();	
			
		$responseData = [
			'uuid' => $_unique,
			'savedTier' => $userTier,
			'searchForm' => $this->_searchHelper->getSearchForm()->createView()
		];
		return $this->render('GodBundle:Tierlist:user.html.twig', $responseData);
	}
}

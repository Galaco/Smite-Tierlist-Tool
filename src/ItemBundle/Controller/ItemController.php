<?php

namespace ItemBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Controller\DefaultController;
use Doctrine\Common\Util\Debug;
use Symfony\Component\HttpFoundation\JsonResponse;

use ItemBundle\Entity\Item;
use ItemBundle\Entity\MenuItem;

class ItemController extends DefaultController
{
	public function IndexAction()
	{
		$items = $this->getDoctrine()
               ->getRepository('ItemBundle:Item')
               ->createQueryBuilder('e')
               ->select('e')
               ->getQuery()
               ->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
		
		$responseData = array(
			"items" => $items,
			'searchForm' => $this->_searchHelper->getSearchForm()->createView()
		);
		
		return $this->render('ItemBundle::index.html.twig', $responseData);
	}
	
	public function ItemAction($_id = 0)
	{
		if (!is_numeric($_id) || $_id == 0) {
			$this->redirect($this->generateUrl('itembundle_item_index'));
		}
		$repository = $this->getDoctrine()
			->getRepository('ItemBundle:Item');
		$item = $repository->find((int)$_id);
		
		if (!$item) {
			$this->redirect($this->generateUrl('itembundle_item_index'));
		} else{
			$rootItem = $repository->find($item->getRootItemId());
				 
			$responseData = array(
				"item" => $rootItem,
				'searchForm' => $this->_searchHelper->getSearchForm()->createView()
			);
			return $this->render('ItemBundle::item.html.twig', $responseData);
		}	
	}
	
	public function jsonItemAction()
	{
		//Save tierlist
		$request = $this->getRequest();
		if ($request->isMethod('POST')) {
			$data = $request->getContent();
			
			if ($data){
				$data = json_decode($data, true);
				if (!is_numeric($data['id']) || $data['id'] == 0) {
					return new JsonResponse(['success' => '0']);
				}
				$repository = $this->getDoctrine()
					->getRepository('ItemBundle:Item');
				$item = $repository->find((int)$data['id']);
				
				if (!$item) {
					return new JsonResponse(['success' => '0']);
				} else{
					$rootItem = $repository->find($item->getRootItemId());
						 
					$responseData = array(
						'success' => '1',
						'item' => $rootItem
					);
					return new JsonResponse(json_encode($responseData));
				}
			}
		}
		return new JsonResponse(['success' => '0']);
	}
}

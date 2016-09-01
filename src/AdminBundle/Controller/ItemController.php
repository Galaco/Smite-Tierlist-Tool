<?php

namespace AdminBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use AppBundle\Controller\DefaultController;
use Symfony\Component\HttpFoundation\StreamedResponse;

use ItemBundle\Entity\Item;
use ItemBundle\Entity\ItemDescriptor;

class ItemController extends DefaultController
{
	public function recacheAction()
	{
		$response = new StreamedResponse();
		
		$response->setCallback(function () {
			$this->recache();
		});
		$response->send();
		
		$response->closeOutputBuffers(1, 0);
		return $response;
	}
	
    public function recache()
    {
		$data = $this->_apiHelper->getItems();

		$em = $this->getDoctrine()->getManager();
		$repository = $this->getDoctrine()->getRepository('ItemBundle:Item');
		$count = 0;
		foreach($data as $jsonItem)
		{
			$item = new Item();
			$item->setId($jsonItem['ItemId']);
			$item->setName(				$jsonItem['DeviceName']);
			$item->setDescription(		$jsonItem['ItemDescription']['Description']);
			$item->setTier(				$jsonItem['ItemTier']);
			$item->setPrice(			$jsonItem['Price']);
			$item->setType(				$jsonItem['Type']);
			$item->setShortDescription(	$jsonItem['ShortDesc']);
			$item->setStartingItem(		$jsonItem['StartingItem']);		
			$item->setIconId(			$jsonItem['IconId']);
			
			$item->setRootItemId(	$repository->find((int)$jsonItem['RootItemId']));
			
			if ($jsonItem['ChildItemId'] != 0) {
				$item->setChildItemId(	$repository->find((int)$jsonItem['ChildItemId']));
			} else {
				$item->setChildItemId(	null);
			}
			
			//Make sure icon is in s3
			$url = 'smite/items/' . $jsonItem['ItemId'] . '.jpg';
			$this->uploadImage($jsonItem['itemIcon_URL'], $url);
			
			$item->setItemIconUrl($this->_awsHelper->getBucketName() . '/' . $url);
			
			
			$itemDescs = [];
			foreach($jsonItem['ItemDescription']['Menuitems'] as $menuItem) {
				$itemDesc = new ItemDescriptor;
				$itemDesc->setItemId($repository->findOneById($jsonItem['ItemId']));
				$itemDesc->setDescription($menuItem['Description']);
				$itemDesc->setValue($menuItem['Value']);
				
				$itemDescs[] = $itemDesc;
			}
			
			try {
				$em->merge($item);
				foreach( $itemDescs as $itemDesc) {
					$em->merge($itemDesc);
				}
			} catch(\Exception $e) {
				$count++;
				//Stream back a response
				$msg = ['progress' => 'Failed to process item: ' . $jsonItem['DeviceName'] . ' ' . $count . '/' . count($data)];
				var_dump(json_encode($msg));
				ob_flush();
				flush();
				
				continue;
			}

			$count++;
			//Stream back a response
			$msg = ['progress' => 'Processed item: ' . $jsonItem['DeviceName'] . ' ' . $count . '/' . count($data)];
			var_dump(json_encode($msg));
			ob_flush();
			flush();
		}
		$em->flush();
    }
	
	
	private function uploadImage($remote, $target)
	{
		if (! $this->_awsHelper->uploadToBucket($remote, $target)) {
			$err[] = 'Failed to upload image: ' . $url . ' to s3';
		}
	}
}

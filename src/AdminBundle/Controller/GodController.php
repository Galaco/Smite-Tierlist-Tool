<?php

namespace AdminBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use AppBundle\Controller\DefaultController;
use Symfony\Component\HttpFoundation\StreamedResponse;

use GodBundle\Entity\God;
use GodBundle\Entity\GodAbility;
use GodBundle\Entity\GodRecommendedItem;
use GodBundle\Entity\GodStats;

class GodController extends DefaultController
{
	public function recacheAction()
	{
		$response = new StreamedResponse();
		
		$response->setCallback(function () {
			$count = 0;
		
			$data = $this->_apiHelper->getGods();
			$total = count($data);
			foreach($data as $jsonGod) {
				$count++;
				
				try {
					$abilities = $this->updateAbilities($jsonGod);		
					$stats = $this->updateStats($jsonGod);			
					$god = $this->updateGod($jsonGod, $stats, $abilities);
					$this->updateRecommendedItems($god);
				} catch(\Exception $e) {
					var_dump($jsonGod);
					var_dump($e->getMessage());
					var_dump('Error processing god: ' . $jsonGod['Name'] . ' ' . $count . '/' . $total);
					$this->flushResponse();
					continue;
				}
				
				//Stream back a response
				var_dump('Processed god: ' . $jsonGod['Name'] . ' ' . $count . '/' . $total);
				$this->flushResponse();	
			}
		});
		$response->send();
		return new JsonResponse(array('response' => 'gods'));
	}
	
	private function updateAbilities($god)
	{
		$em = $this->getDoctrine()->getManager();
		$abilities = [];
		$i=0;
		
		try {
			while ($i < 5)
			{
				$abilities[$i] = new GodAbility();

				$abilities[$i]->setId(				$god['Ability_' . (string)($i+1)]['Id']);
				$abilities[$i]->setSummary(			$god['Ability_' . (string)($i+1)]['Summary']);
					
				//Make sure s3 has the ability image
				$url = "smite/gods/abilities/" . end(explode("/", $god['Ability_' . (string)($i+1)]['URL']));
				$this->_awsHelper->uploadToBucket(	$god['Ability_' . (string)($i+1)]['URL'], $url);
					
				$abilities[$i]->setUrl(				$this->_awsHelper->getBucketName() . '/' . $url);
				$abilities[$i]->setDescription(		$god['Ability_' . (string)($i+1)]['Description']['itemDescription']['description']);
				$abilities[$i]->setCooldown(		$god['Ability_' . (string)($i+1)]['Description']['itemDescription']['cooldown']);
				$abilities[$i]->setCost(			$god['Ability_' . (string)($i+1)]['Description']['itemDescription']['cost']);
					
				$em->merge($abilities[$i]);
				$i++;
			}
			
			$em->flush();
		} catch(\Exception $e) {
			var_dump($abilities);
			throw new \Exception('Failure updating abilities.');
		}
		
		return $abilities;
	}
	
	private function updateStats($god)
	{
		$em = $this->getDoctrine()->getManager();
		
		try {
			$stats = new GodStats();
			$stats->setGodId(						$god['id']);	
			$stats->setAttackSpeed(					$god['AttackSpeed']);
			$stats->setAttackSpeedPerLevel(			$god['AttackSpeedPerLevel']);
			$stats->setCons(						$god['Cons']);
			$stats->setHP5PerLevel(					$god['HP5PerLevel']);
			$stats->setHealth(						$god['Health']);
			$stats->setHealthPerFive(				$god['HealthPerFive']);
			$stats->setHealthPerLevel(				$god['HealthPerLevel']);
			$stats->setMp5PerLevel(					$god['MP5PerLevel']);
			$stats->setMagicProtection(				$god['MagicProtection']);
			$stats->setMagicProtectionPerLevel(		$god['MagicProtectionPerLevel']);
			$stats->setMagicalPower(				$god['MagicalPower']);
			$stats->setMagicalPowerPerLevel(		$god['MagicalPowerPerLevel']);
			$stats->setMana(						$god['Mana']);
			$stats->setManaPer5(					$god['ManaPerFive']);
			$stats->setManaPerLevel(				$god['ManaPerLevel']);
			$stats->setPhysicalPower(				$god['PhysicalPower']);
			$stats->setPhysicalPowerPerLevel(		$god['PhysicalPowerPerLevel']);
			$stats->setPhysicalProtection(			$god['PhysicalProtection']);
			$stats->setPhysicalProtectionPerLevel(	$god['PhysicalProtectionPerLevel']);
			$stats->setSpeed(						$god['Speed']);	
				
			$em->merge($stats);	
			$em->flush();
		} catch(\Exception $e) {
			var_dump($stats);
			throw new \Exception('Failure updating stats.');
		}
		
		
		return $stats;
	}
	
	private function updateGod($jsonGod, $stats, $abilities)
	{
		$em = $this->getDoctrine()->getManager();
		
		try {
			$god = new God();
			$god->setId(		$jsonGod['id']);
			$god->setGodStatsId($stats);
			$god->setName(		$jsonGod['Name']);
			$god->setTitle(		$jsonGod['Title']);
			$god->setRole(		$jsonGod['Roles']);
			$god->setPantheon(	$jsonGod['Pantheon']);
			$god->setType(		$jsonGod['Type']);
			$god->setLore(		$jsonGod['Lore']);
				
			$url = "smite/gods/" . $jsonGod['id'] . "c.jpg";
			$this->_awsHelper->uploadToBucket(	$jsonGod['godCard_URL'], $url);
			$god->setGodCardUrl($this->_awsHelper->getBucketName() . '/' . $url);
				
			$url = "smite/gods/" . $jsonGod['id'] . ".jpg";
			$this->_awsHelper->uploadToBucket(	$jsonGod['godIcon_URL'], $url);
			$god->setGodIconUrl($this->_awsHelper->getBucketName() . '/' . $url);
				
			$god->setPros(		$jsonGod['Pros']);
			$god->setAbilityId1($abilities[0]);
			$god->setAbilityId2($abilities[1]);
			$god->setAbilityId3($abilities[2]);
			$god->setAbilityId4($abilities[3]);
			$god->setAbilityId5($abilities[4]);
				
			$em->merge($god);
				
			//Flush data to database			
			$em->flush();
		} catch(\Exception $e) {
			var_dump($god);
			throw new \Exception('Failure updating god.');
		}
			
		return $god;
	}
	
	private function updateRecommendedItems($god)
	{
		$em = $this->getDoctrine()->getManager();
		
		$recommendedItem = false;
		try {
			$recommendedItems = $this->_apiHelper->getGodRecommendedItems($god->getId());
			foreach($recommendedItems as $jsonItem) {
				$item = $em->getRepository('ItemBundle:Item')->findOneById($jsonItem['item_id']);
				$god2 = $em->getRepository('GodBundle:God')->findOneById($god->getId());

				$recommendedItem = new GodRecommendedItem;
				$recommendedItem->setGodId(		$god2);
				$recommendedItem->setItemId(	$item);
				$recommendedItem->setCategory(	$jsonItem['Category']);	
				$recommendedItem->setItemName(	$jsonItem['Item']);
				$recommendedItem->setRole(		$jsonItem['Role']);
				
				$em->merge($recommendedItem);
			}
			
			$em->flush();
		} catch(\Exception $e) {
			var_dump($recommendedItem);
			throw new \Exception('Failure updating recommended items.');
		}
	}
	
	private function flushResponse()
	{
		ob_flush();
		flush();
	}
}

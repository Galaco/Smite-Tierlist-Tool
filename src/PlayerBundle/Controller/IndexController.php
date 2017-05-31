<?php

namespace PlayerBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Controller\DefaultController;

use PlayerBundle\Entity\Player;

class IndexController extends DefaultController
{
	public function IndexAction($_username = -1)
	{
		if ($_username == -1) {
			return $this->redirect($this->generateUrl('playerbundle_index_top'));
		}
		
		$em = $this->getDoctrine()->getManager();
		$player = $em->getRepository('PlayerBundle\Entity\Player')->findOneBy(array('username' => $_username));
		if (!$player) {
			return $this->redirect($this->generateUrl('playerbundle_index_recache', array('_username' => $_username)));
		}
		
		//Create response array
		$responseData = array(
			'player' => $player,
			'searchForm' => $this->_searchHelper->getSearchForm()->createView()
		);
		return $this->render('PlayerBundle::index.html.twig', $responseData);
	}
	
	public function recacheAction($_username = -1)
	{
		if ($_username == -1) {
			return $this->redirect($this->generateUrl('playerbundle_index_top'));
		}
		$data = $this->_apiHelper->getPlayer($_username);
		if (count($data) != 1 || strlen($data[0]['Name']) < 4) {
			return $this->redirect($this->generateUrl('playerbundle_index_top'));
		}
		$data = $data[0];
		
		$player = new Player;
		$player->setId($data['Id']);
		$name = explode (']', $data['Name']);
		$player->setUsername(end($name));
		$player->setAvatarUrl($data['Avatar_URL']);
		$player->setDateCreated($data['Created_Datetime']);
		$player->setDateLastLogin($data['Last_Login_Datetime']);
		$player->setLeaves($data['Leaves']);
		$player->setLevel($data['Level']);
		$player->setWins($data['Wins']);
		$player->setLosses($data['Losses']);
		$player->setMasteryLevel($data['MasteryLevel']);
		$player->setTierConquest($data['Tier_Conquest']);
		$player->setTierJoust($data['Tier_Joust']);
		$player->setTotalAchievements($data['Total_Achievements']);
		$player->setTotalWorshippers($data['Total_Worshippers']);
		
		$m = $this->getDoctrine()->getManager();		
		$m->merge($player);
		$m->flush();
		
		return $this->redirect($this->generateUrl('playerbundle_index_index', array('_username' => $_username)));
	}
	
	public function topAction()
	{
		
	}
}

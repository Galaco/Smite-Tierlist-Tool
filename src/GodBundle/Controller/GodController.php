<?php

namespace GodBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Controller\DefaultController;

use GodBundle\Entity\God;
use GodBundle\Entity\GodAbility;
use GodBundle\Entity\GodStats;
use GodBundle\Entity\TierListGod;

class GodController extends DefaultController
{
	public function IndexAction()
	{
		//All gods
		$gods = $this->getDoctrine()
               ->getRepository('GodBundle:God')
               ->createQueryBuilder('e')
               ->select('e')
               ->getQuery()
               ->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
			   
		$m = $this->getDoctrine()->getManager();
		$qb = $m->createQueryBuilder();
		
		//Most popular per role
		/*$popular = $qb->add('select', "mg, g.id, g.name, g.role, g.god_icon_url, SUM(mg.god_id) AS magnitude, sum(case when g.role = ' Hunter' then 1 else 0 end) AS hunterCount, sum(case when g.role = ' Mage' then 1 else 0 end) AS mageCount, sum(case when g.role = ' Warrior' then 1 else 0 end) AS warriorCount, sum(case when g.role = ' Assassin' then 1 else 0 end) AS assassinCount, sum(case when g.role = ' Guardian' then 1 else 0 end) AS guardianCount")
			->from('MatchBundle\Entity\MatchGod', 'mg')
			->join('GodBundle\Entity\God', 'g')
			->where('mg.god_id = g.id')
			->groupBy("g.id")
			->orderBy('magnitude', 'DESC')
			->setMaxResults(20)
			->getQuery()
			->getResult();

		/*$qb = $m->createQueryBuilder();
		//Top picks per role
		$picks = $qb->add('select', 'mg, g.id, g.name, g.role, g.god_icon_url, COUNT(mg) AS magnitude')
			->from('MatchBundle\Entity\MatchGod', 'mg')
			->join('GodBundle\Entity\God', 'g')
			->where('mg.god_id = g.id')
			->groupBy("g.role")
			->orderBy('magnitude', 'DESC')
			->setMaxResults(5)
			->getQuery()
			->getResult();*/
		
		//Create response array
		$responseData = array(
			'allGods' => $gods,
			//'mostPlayed' => $popular,
			//'topPicks' => $picks,
			'searchForm' => $this->_searchHelper->getSearchForm()->createView()
		);
		
		return $this->render('GodBundle::index.html.twig', $responseData);
	}
	
	public function GodAction($_id)
	{
		if ($_id == -1 || (int)$_id < 1000 || (int)$_id > 3000 || !is_numeric($_id)) {
			return $this->redirect($this->generateUrl('godbundle_god_index'));
		}
		$god = $this->getDoctrine()
            ->getRepository('GodBundle:God')
            ->createQueryBuilder('god')
            ->select('god, ability1, ability2, ability3, ability4, ability5, godstats')
			->where('god.id = :identifier')
			->setParameter('identifier', $_id)
			
			->leftJoin('god.ability_id_1', 'ability1')
			->leftJoin('god.ability_id_2', 'ability2')
			->leftJoin('god.ability_id_3', 'ability3')
			->leftJoin('god.ability_id_4', 'ability4')
			->leftJoin('god.ability_id_5', 'ability5')	   
			->leftJoin('god.god_stats_id', 'godstats')
            ->getQuery()
            ->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
			   
		$god[0]['lore'] = nl2br(str_replace('\\n', "\n", $god[0]['lore']));
		//Default recommended items
		$recommendedItems = $this->getDoctrine()
			->getRepository('GodBundle:GodRecommendedItem')
			->createQueryBuilder('recommendeditem')
			->select('recommendeditem')
			->where('recommendeditem.god_id = :identifier')
			->setParameter('identifier', $_id)
			->getQuery()
            ->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
			
		//Calculated recommended items
		$em = $this->getDoctrine()->getManager();
		$topItems = [];
		for($i = 1; $i < 7; $i++) {			
			$qb = $em->createQueryBuilder();

			$topItems[] = $qb->add('select', 'COUNT(mg) AS magnitude, it')
				->from('MatchBundle\Entity\MatchGod', 'mg')
				->join('ItemBundle\Entity\Item', 'it')
				->where('mg.god_id = :godId')
				->andWhere("mg.item_{$i} = it.id")
				->groupBy("mg.item_{$i}")
				->orderBy('magnitude', 'DESC')
				->setParameter('godId', $_id)
				->setMaxResults(5)
				->getQuery()
				->getResult();
		}
		
		$qb = $em->createQueryBuilder();
		$totalItems = $qb->add('select', 'COUNT(mg) AS magnitude')
			->from('MatchBundle\Entity\MatchGod', 'mg')
			->where('mg.god_id = :godId')
			->setParameter('godId', $_id)
			->getQuery()
			->getResult();
		
		$responseData = array(
			"god" => $god[0],
			'recommendedItems' => $recommendedItems,
			'popularItems' => $topItems,
			'totalItems' => $totalItems[0],
			'searchForm' => $this->_searchHelper->getSearchForm()->createView()
		);
		return $this->render('GodBundle::god.html.twig', $responseData);
	}
}

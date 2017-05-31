<?php

namespace AdminBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Controller\DefaultController;
use Doctrine\ORM\Query\ResultSetMapping;

use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\Model\UserInterface;

class IndexController extends DefaultController
{
	public function IndexAction()
	{		
		$hdd_total = ((int)(disk_total_space("/")/1000000))/1000;
		$hdd_usage = $hdd_total - ((int)(disk_free_space("/")/1000000))/1000;
		$mem_usage = (int)(memory_get_usage()/1000000 );
		
		/*$rsm = new ResultSetMapping();
		$rsm->addIndexByScalar('unique_name');
		$rsm->addScalarResult('smite', 'smite');
		$rsm->addScalarResult('size in MB', 'size in MB');
		$query = $this
			->getDoctrine()
			->getManager()
			->createNativeQuery('SELECT table_schema "smite", sum(data_length + index_length)/1024/1024 "size in MB" FROM information_schema.TABLES GROUP BY table_schema', $rsm);
		$db_size = $query->getArrayResult();*/		
		
		$responseData = array(
			'searchForm' => $this->_searchHelper->getSearchForm()->createView(),
			'hddUsage' => $hdd_usage . '/' . $hdd_total . 'GB used',
			'ramUsage' => $mem_usage . 'MB used by PHP',
			'cpuUsage' => 0,//(sys_getloadavg()[0]),
			'dbSize' => ''//$db_size['']['size in MB'] . 'MB'
		);	
		return $this->render('AdminBundle::index.html.twig', $responseData);
	}
}

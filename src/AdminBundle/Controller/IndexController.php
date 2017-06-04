<?php

namespace AdminBundle\Controller;

use AppBundle\Controller\AbstractController;

class IndexController extends AbstractController
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

		$serverStats = [
            'hddUsage' => $hdd_usage . '/' . $hdd_total . 'GB used',
            'ramUsage' => $mem_usage . 'MB used by PHP',
            'cpuUsage' => 0,//(sys_getloadavg()[0]),
            'dbSize' => ''//$db_size['']['size in MB'] . 'MB'
        ];

        $provider = $this->getFormProvider();
		$forms = [
		    'addgame' => $provider->getAddGameForm()->createView()
        ];
		
		$viewData = [
		    'serverStats' => $serverStats,
            'forms'   => $forms

        ];
		return $this->render('AdminBundle::index.html.twig', $viewData);
	}


	public function AddGameAction()
    {
        $provider = $this->getFormProvider();

        $form = $provider->getAddGameForm();
        if ($form->isValid()) {
            $data = $form->getData();

            //Save new game
        }

        return $this->forward('AdminBundle:Index:index');
    }

    private function getFormProvider()
    {
        return new \AdminBundle\Form\Provider(
            $this->container->get('router'),
            $this->container->get('request'),
            $this->container->get('form.factory')
        );
    }
}

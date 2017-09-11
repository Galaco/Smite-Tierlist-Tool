<?php

namespace AdminBundle\Controller;

use AppBundle\Controller\AbstractController;

/**
 * Class IndexController
 * @package AdminBundle\Controller
 */
class IndexController extends AbstractController
{

    /**
     * Admin index route.
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
	public function IndexAction()
	{
        /** @var \AdminBundle\Form\Provider */
        $provider = $this->getFormProvider();
		$forms = [
		    'addgame' => $provider->getAddGameForm()->createView()
        ];
		
		$viewData = [
            'forms'   => $forms
        ];
		return $this->render('AdminBundle::index.html.twig', $viewData);
	}

    /**
     * Add support for a new game form process.
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
	public function AddGameAction()
    {
        /** @var \AdminBundle\Form\Provider */
        $provider = $this->getFormProvider();

        /** @var \AdminBundle\Form\Type\AddGame $form */
        $form = $provider->getAddGameForm();
        if ($form->isValid()) {
            $data = $form->getData();

            //Save new game
            //Currently unhandled, as adding a new game currently will not work.
        }

        return $this->forward('AdminBundle:Index:index');
    }

    /**
     * Get admin form provider.
     *
     * @return \AdminBundle\Form\Provider
     */
    private function getFormProvider()
    {
        return new \AdminBundle\Form\Provider(
            $this->container->get('router'),
            $this->container->get('request'),
            $this->container->get('form.factory')
        );
    }
}

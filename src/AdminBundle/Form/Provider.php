<?php

namespace AdminBundle\Form;

use Symfony\Bundle\FrameworkBundle\Routing\Router;

/**
 * Form provider.
 *
 * @package AdminBundle\Form
 */
class Provider
{
    /**
     * @var Router
     */
    private $_router;

    /**
     * @var \Symfony\Component\HttpFoundation\Request
     */
    private $_request;

    /**
     * @var
     */
    private $_factory;


    /**
     * Provider constructor.
     *
     * @param $router
     * @param $request
     * @param $factory
     */
    public function __construct(Router $router, \Symfony\Component\HttpFoundation\Request $request, $factory)
    {
        $this->_router  = $router;
        $this->_request = $request;
        $this->_factory = $factory;
    }

    /**
     * Get a new add game form.
     *
     * @return mixed
     */
    public function getAddGameForm()
    {
        $formType = new Type\AddGame($this->_router);

        return $this->_processForm($formType);
    }


    /**
     * Process filled form.
     *
     * @param $formType
     * @param array $formData
     * @return mixed
     */
    private function _processForm($formType, $formData = [])
    {
        $form = $this->_factory->create($formType, $formData);

        $form->handleRequest($this->_request);

        return $form;
    }
}
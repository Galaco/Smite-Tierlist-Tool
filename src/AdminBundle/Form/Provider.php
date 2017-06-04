<?php

namespace AdminBundle\Form;


class Provider
{
    private $_router;

    private $_request;

    private $_factory;


    public function __construct($router, $request, $factory)
    {
        $this->_router  = $router;
        $this->_request = $request;
        $this->_factory = $factory;
    }

    public function getAddGameForm()
    {
        $formType = new Type\AddGame($this->_router);

        return $this->_processForm($formType);
    }


    private function _processForm($formType, $formData = [])
    {
        $form = $this->_factory->create($formType, $formData);

        $form->handleRequest($this->_request);

        return $form;
    }
}
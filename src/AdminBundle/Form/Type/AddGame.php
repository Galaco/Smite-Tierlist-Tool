<?php

namespace AdminBundle\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bundle\FrameworkBundle\Routing\Router;

class AddGame extends AbstractType
{
    const FORM_NAME = 'addgame';

    /**
     * @var Router
     */
    private $_router;


    /**
     * Constructor
     *
     * @param Router  $router
     */
    public function __construct(Router $router)
    {
        $this->_router = $router;
    }


    /**
     * Construct the form elements.
     *
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $route = $this->_router->generate('adminbundle_index_addgame', []);

        $builder
            ->setAction($route)
            ->setMethod('POST')
            ->add('name', 'text', array(
                'label' => false,
                'attr' => array(
                    'placeholder' => 'Title'
                )
            ))
            ->add('shortname', 'text', array(
                'label' => false,
                'attr' => array(
                    'placeholder' => 'Short name'
                )
            ))
            ->add('Add', 'submit');
    }


    /**
     * Returns form name.
     *
     * @return string
     */
    public function getName()
    {
        return $this::FORM_NAME;
    }
}
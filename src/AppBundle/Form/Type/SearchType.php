<?php
 
//src/AppBundle/Form/Type/SearchType.php
namespace AppBundle\Form\Type;
 
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Bundle\FrameworkBundle\Routing\Router;
 
class SearchType extends AbstractType
{
	 /**
     * @var Router
     */
    private $router;
	
	/**
     * @param Router
     */
    public function __construct(Router $router)
    {
        $this->router = $router;
    }
	
    public function buildForm(FormBuilderInterface $builder, array $options)
    {        
		$route = $this->router->generate('appbundle_home_search', []);
		
		$builder
			->setAction($route)
			->setMethod('POST')
			->add('name', 'text', array(
				'label' => false,
				'attr' => array(
					'placeholder' => 'Search..'
				)
			))
			->add('type', 'choice', array(
				'choices' => array(
					"player" => "Players", 
					"god" => "Gods",
				),
				'multiple' => false,
				'expanded' => false,
				'label' => false,
				'attr' => array(
					'placeholder' => 'type'
				)
			))
			->add('Search', 'submit');
	}
	
	public function getName() 
	{
		return 'search';
	}
}
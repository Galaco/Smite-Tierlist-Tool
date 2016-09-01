<?php
 
//src/AppBundle/Form/Type/SearchType.php
namespace GodBundle\Form\Type;
 
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Bundle\FrameworkBundle\Routing\Router;
 
class TierlistType extends AbstractType
{
	 /**
     * @var Router
     */
    private $router;
	
	private $_count;
	
	/**
     * @param Router
     */
    public function __construct(Router $router, $count)
    {
        $this->router = $router;
		$this->_count = $count;
    }
	
    public function buildForm(FormBuilderInterface $builder, array $options)
    {        
		$route = $this->router->generate('godbundle_tierlist_save', []);
		
		$builder
			->setAction($route)
			->setMethod('POST');
		for ($i=0; $i<count($this->_count); $i++) {
				$builder->add('god_' . $this->_count[$i]['id'], 'hidden', array(
				'label' => false,
			));
		}
		$builder->add('Save', 'submit');
	}
	
	public function getName() 
	{
		return 'tierlist';
	}
}
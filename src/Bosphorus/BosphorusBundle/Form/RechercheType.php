<?php
namespace Bosphorus\BosphorusBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class RechercheType extends AbstractType
{
    public function buildForm(FormbuilderInterface $builder, array $option)
    {
        $builder->add('recherche', 'text', array('label' => false,
                                                 'attr' => array('placeholder' => 'Rechercher',
                                                                 'id' => 'rechercher')));
    }
    
    public function getName()
    {
        return 'bosphorus_bosphorusbundle_recherche';
    }
}
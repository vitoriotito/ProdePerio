<?php
/*
 * This file is part of the FOSUserBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace ProdeBundle\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use ProdeBundle\Entity\User;


class RegistrationType extends AbstractType
{
    private $class;
    /**
     * @param string $class The User class name
     */
    public function __construct($class)
    {
        $this->class = $class;
    }
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $builder
        ->add('nombre', null, array('label' => 'Nombre', 'translation_domain' => 'FOSUserBundle'))
        ->add('apellido', null, array('label' => 'Apellido', 'translation_domain' => 'FOSUserBundle'))
        ->add('legajo', null, array('label' => 'Legajo', 'translation_domain' => 'FOSUserBundle'))
        ->add('equipo', null, array('label' => 'Equipo', 'translation_domain' => 'FOSUserBundle'))
        
        ;
    }
    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';
    }
    public function getName()
    {
        return 'prode_user_registration';
    }
}
<?php

namespace WF\UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
//use Symfony\Component\Form\Extension\Core\Type\FileType;

class ProfileFreelancerFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom','text')
            ->add('prenom','text')
            ->add('cv')
            ->add('resume','textarea')
            ->add('dateNaiss','birthday')
            ->add('file','file', array('required' => false))
            ->add('adresse')
            ->add('dispo','checkbox')
            /*->add('tests')*/
            /*->add('formations')
            ->add('competences')*/

            
            ;
    }

    public function getParent()
    {
        /*return 'FOS\UserBundle\Form\Type\RegistrationFormType';*/

        // Or for Symfony < 2.8
        return 'fos_user_profile';
    }

    public function getBlockPrefix()
    {
        return 'app_user_profile';
    }

    // For Symfony 2.x
    public function getName()
    {
        return $this->getBlockPrefix();
    }
}
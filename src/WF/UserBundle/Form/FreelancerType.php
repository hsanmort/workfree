<?php

namespace WF\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class FreelancerType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('cv')
            ->add('resume')
            ->add('dispo')
            ->add('tests')
            ->add('formations')
            ->add('competences')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'WF\UserBundle\Entity\Freelancer'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'wf_userbundle_freelancer';
    }
}

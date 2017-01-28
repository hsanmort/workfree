<?php

namespace WF\PlatformBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class FormationType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dateFormation', null, array(
                'attr' => array(
                    'class' => 'sky-form')))
            ->add('titreFormation', null, array(
                'attr' => array(
                    'class' => 'sky-form')))
            ->add('descriptionFormation', null, array(
                'attr' => array(
                    'class' => 'sky-form')))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'WF\PlatformBundle\Entity\Formation'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'wf_platformbundle_formation';
    }
}

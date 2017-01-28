<?php

namespace WF\PlatformBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PropositionType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('descriptionPropo',null, array(
                'label' => 'Description Proposition',
                'attr' => array(
                    'class' => 'inputProp')) )
            
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'WF\PlatformBundle\Entity\Proposition'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'wf_platformbundle_proposition';
    }
}

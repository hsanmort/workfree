<?php

namespace WF\PlatformBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\Common\Collections\ArrayCollection;


class ProjetType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('intitule','text')
            ->add('description','textarea')
            ->add('duree')
            ->add('dateDebut','date')
            ->add('budget')
            ->add('etat')
            //->add('avancement')
            ->add('file','file', array('required' => false))

            //->add('noteClient')
            //->add('noteFreelancer')
            ->add('published', 'checkbox', array('required' => false))
            ->add('categorie','entity',array(
                'class'          => 'WFPlatformBundle:Categorie',
                'property'      => 'nomCat',   
                'multiple'     =>false
                
                ))
            ->add('client')
            //->add('paiement')
            
            ->add('offre','entity',array(
                'class'          => 'WFPlatformBundle:Offre',
                'property'      => 'description',   
                'multiple'     =>false
                ))
            ->add('save','submit')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'WF\PlatformBundle\Entity\Projet'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'wf_platformbundle_projet';
    }
}

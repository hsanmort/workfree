<?php 
namespace WF\PlatformBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class ProjetAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('categorie', 'entity', array(
                'class' => 'WF\PlatformBundle\Entity\Categorie',
                'property' => 'nomCat',
            ))
            ->add('intitule', null)
            ->add('description', null)
            ->add('photo', null)
            ->add('budget', null)
            ->add('dateDebut', null)
            ->add('duree', null)
            ->add('client', 'entity', array(
                'class' => 'WF\UserBundle\Entity\Client',
                'property' => 'nom',
            ))
            
            ->add('noteClient', null)
            ->add('noteFreelancer', null)
            ->add('etat', null)
            ->add('published', null);
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('categorie', null, array(), 'entity', array(
                'class' => 'WF\PlatformBundle\Entity\Categorie',
                'property' => 'nomCat',
            ))
            ->add('intitule', null)
            ->add('budget', null)
            ->add('client', null, array(), 'entity', array(
                'class' => 'WF\UserBundle\Entity\Client',
                'property' => 'id',
            ))
            ->add('published', null);
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('intitule', null)
            ->add('description', null)
            ->add('photo', null)
            ->add('budget', null)
            ->add('dateDebut', null)
            ->add('duree', null)
            ->add('client', null, array(), 'entity', array(
                'class' => 'WF\UserBundle\Entity\Client',
                'property' => 'id',
            ))
            
            
            ->add('published', null);
    }
}
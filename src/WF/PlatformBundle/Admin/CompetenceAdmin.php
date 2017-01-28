<?php 
namespace WF\PlatformBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class CompetenceAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('nomComp', 'text')
            ->add('categorie', 'entity', array(
                'class' => 'WF\PlatformBundle\Entity\Categorie',
                'property' => 'nomCat',
            ));
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('nomComp')
            ->add('categorie', null, array(), 'entity', array(
                'class'    => 'WF\PlatformBundle\Entity\categorie',
                'property' => 'nomCat',
            ));
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('nomComp')
            ->add('categorie', 'entity', array(
                'class'    => 'WF\PlatformBundle\Entity\categorie',
                'associated_property' => 'nomCat',
            ));
    }
}
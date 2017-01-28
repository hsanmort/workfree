<?php 
namespace WF\PlatformBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;

class TestAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('nomTest',null)
            ->add('delai',null)
            ->add('scoreMin',null)
            ->add('verified',null);
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('nomTest', null)
            ->add('recruteur', null, array(), 'entity', array(
                'class' => 'WF\UserBundle\Entity\Recruteur',
                'property' => 'username'))
            ->add('questions', null, array(), 'entity', array(
                'class' => 'WF\PlatformBundle\Entity\Question',
                'property' => 'textQues'))
            ->add('verified', 'doctrine_orm_string', array(), 'choice', array('choices' => array(
                "0" => "no",
                "1" => "yes"
                )));
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('nomTest', null)
            ->add('recruteur', 'entity', array(
                'class'    => 'WF\UseBundle\Entity\Recruteur',
                'property' => 'username'))
            ->add('verified', null);
    }

    protected function configureRoutes(RouteCollection $collection)
    {
        //$collection->remove('delete'); // to remove a single route
        // OR remove all route except named ones
        //$collection->clearExcept(array('batch', 'create', 'list', 'show', 'edit', 'delete'));
        $collection->remove('export');
        $collection->remove('create');
    }
}
<?php 
namespace WF\PlatformBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;

class FreelancerAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('enabled', null);
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('username', null)
            ->add('email', null)
            ->add('enabled', 'doctrine_orm_string', array(), 'choice', array('choices' => array(
                "0" => "no",
                "1" => "yes"
                )));
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('username', null)
            ->add('email', null)
            ->add('enabled', null);
    }

    protected function configureRoutes(RouteCollection $collection)
    {
        //$collection->remove('delete'); // to remove a single route
        // OR remove all route except named ones
        $collection->clearExcept(array('list', 'show', 'edit'));
    }
}
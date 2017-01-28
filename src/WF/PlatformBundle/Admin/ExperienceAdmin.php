<?php 
namespace WF\PlatformBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class ExperienceAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('titreExp', null)
            ->add('dateExp', null)
            ->add('descriptionExp', null)
            ->add('freelancer', 'entity', array(
                'class' => 'WF\UserBundle\Entity\Freelancer',
                'property' => 'id',
            ));
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('titreExp');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('titreExp', null)
            ->add('dateExp', null)
            ->add('descriptionExp', null)
            ->add('freelancer', 'entity', array(
                'class' => 'WF\UserBundle\Entity\Freelancer',
                'associated_property' => 'id',
            ));
    }
}
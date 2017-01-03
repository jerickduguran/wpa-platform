<?php
 
namespace Application\Sonata\PageBundle\Admin;

use Sonata\PageBundle\Admin\SiteAdmin as BaseAdmin;  
use Sonata\AdminBundle\Form\FormMapper; 

/**
 * Admin definition for the Site class.
 *
 * @author Thomas Rabaix <thomas.rabaix@sonata-project.org>
 */
class SiteAdmin extends BaseAdmin
{ 
    /**
     * {@inheritdoc}
     */
    protected function configureFormFields(FormMapper $formMapper)
    { 
        $formMapper
            ->with('form_site.label_general', array('class' => 'col-md-6'))
                ->add('name')
                ->add('isDefault', null, array('required' => false))
                ->add('enabled', null, array('required' => false))
                ->add('host')
                ->add('locale', 'locale', array(
                    'required' => false,
                ))
                ->add('relativePath', null, array('required' => false))
                ->add('enabledFrom', 'sonata_type_datetime_picker', array('dp_side_by_side' => true))
                ->add('enabledTo', 'sonata_type_datetime_picker', array(
                    'required' => false,
                    'dp_side_by_side' => true,
                ))
            ->end()
            ->with('form_site.label_seo', array('class' => 'col-md-6'))
                ->add('title', null, array('required' => false))
                ->add('metaDescription', 'textarea', array('required' => false))
                ->add('metaKeywords', 'textarea', array('required' => false))
            ->end()
        ;
    }
 
}

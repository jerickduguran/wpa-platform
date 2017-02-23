<?php

namespace WPA\APIBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class ClientAdmin extends AbstractAdmin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
		    ->add("name")
            ->add('randomId',null,array('label' => 'Client ID')) 
            ->add('secret',null,array('label' => 'Client Secret')) 
            ->add('id')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
		    ->add("name")
            ->add('publicId',null,array('label' => 'Client ID')) 
            ->add('secret',null,array('label' => 'Client Secret')) 
            ->add('id')
            ->add('_action', null, array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                )
            ))
        ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
		    ->add("name");
		
        if ($this->getSubject()->getId()) {
            $publicId = $this->getSubject()->getPublicId();
            $formMapper 
                    ->add('getPublicId', 'text', array(
                        'attr'     => array('readonly' => true),
                        'data'     => $publicId,
                        'required' => false,
						'label' => 'Client ID',
                        'mapped'   => false
                    ));
        }
		
        $formMapper 
            ->add('secret',null,array('label' => 'Client Secret',
                        'attr'     => array('readonly' => true))) 
            ->add('redirectUris','sonata_type_native_collection',
                array(
                    'allow_add'    => true,
                    'allow_delete' => true,
                    'type'         => 'text',
                    'error_bubbling' => false,
                    'options'      => array(
                        'label'    => false,
                        'required' => false,
                        'attr'     => array(
                            'class' => 'span12'
                        )
                    )
                ))
            ->add('allowedGrantTypes','sonata_type_native_collection',
					array(
						'allow_add'    => true,
						'allow_delete' => true,
						'error_bubbling' => false,
						'options'      => array(
							'label'    => false,
							'required' => false,
							'attr'     => array(
								'class' => 'span12'
							)
						)
					)) 
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
		    ->add("name")
            ->add('randomId')
            ->add('redirectUris')
            ->add('secret')
            ->add('allowedGrantTypes')
            ->add('id')
        ;
    }
}

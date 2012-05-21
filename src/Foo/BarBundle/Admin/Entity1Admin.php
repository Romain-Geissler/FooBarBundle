<?php

namespace Foo\BarBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Form\FormMapper;

class Entity1Admin extends Admin{
	public function configureFormFields(FormMapper $formMapper){
		$linkParameters=array();

		$formMapper
			->add('name')
			->add('subEntities','sonata_type_collection',array('by_reference'=>false),array(
				'edit'=>'inline',
				'inline'=>'table',
				'sortable'=>'position'
			))
		;
	}

	public function configureListFields(ListMapper $listMapper){
		$listMapper
			->addIdentifier('name')
			->add('subEntities')
			->add('_action',null,array(
				'actions'=>array(
					'edit'=>array(),
					'delete'=>array()
				)
			));
		;
	}
}

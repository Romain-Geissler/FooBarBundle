<?php

namespace Foo\BarBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Form\FormMapper;

class Entity2Admin extends Admin{
	public function configureFormFields(FormMapper $formMapper){
		$linkParameters=array();

		$formMapper
			->add('name')
			->add('position')
		;
	}

	public function configureListFields(ListMapper $listMapper){
		$listMapper
			->addIdentifier('name')
			->addIdentifier('position')
		;
	}
}

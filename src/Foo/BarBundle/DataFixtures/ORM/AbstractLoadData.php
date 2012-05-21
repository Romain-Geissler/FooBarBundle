<?php

namespace Foo\BarBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

abstract class AbstractLoadData extends AbstractFixture implements OrderedFixtureInterface,ContainerAwareInterface{
	/*
	//the subclass must define
	const ENTITY_CLASS='TheEntityClass';
	const REFERENCE_NAME='entityName';

	//and the input rows:
	protected function getInputRows(){
		return array(
			array(
				'property11'=>value11,
				'property12'=>value12,
				'property13'=>value13
			),
			array(
				'property21'=>value21,
				'property22'=>value22,
				'property23'=>value23
			)
		);
	}
	*/

	protected $container;

	public function setContainer(ContainerInterface $container=null){
		$this->container=$container;
	}

	public function load(ObjectManager $manager){
		$inputRows=$this->getInputRows();
		$validator=$this->container->get('validator');
		$translator=$this->container->get('translator');

		foreach($inputRows as $inputRow){
			$entityClass=static::ENTITY_CLASS;
			$entity=new $entityClass();

			foreach($inputRow as $key=>$value){
				$methodName='set'.ucfirst($key);
				$entity->$methodName($value);
			}

			$errors=$validator->validate($entity);

			if(count($errors)>0){
				$errorMessage=$translator->trans($errors[0]->getMessageTemplate(),$errors[0]->getMessageParameters(),'validators');

				throw new \ErrorException('Validation error: '.$errorMessage);
			}

			$manager->persist($entity);
			$manager->flush();

			$this->addEntityReference($entity);
		}
	}

	public function getOrder(){
		return LoadDataOrder::getOrder($this);
	}

	public static function getReferenceNameById($id){
		return static::REFERENCE_NAME.$id;
	}

	protected function addEntityReference($entity){
		$this->addReference(static::getReferenceNameById($entity->getId()),$entity);
	}

	abstract protected function getInputRows();
}

<?php

namespace Foo\BarBundle\DataFixtures\ORM;

use Foo\BarBundle\Entity\Building;
use Foo\BarBundle\Entity\Entity2;
use Foo\BarBundle\Entity\OrderStatus;
use Doctrine\Common\Persistence\ObjectManager;

class LoadEntity1Data extends AbstractLoadData{
	const ENTITY_CLASS='Foo\BarBundle\Entity\Entity1';
	const REFERENCE_NAME='Entity1';

	protected function getInputRows(){
		$entity2_1=new Entity2();
		$entity2_1->setName('Entity2 1');
		$entity2_1->setPosition(1);

		$entity2_2=new Entity2();
		$entity2_2->setName('Entity2 2');
		$entity2_2->setPosition(2);

		$entity2_3=new Entity2();
		$entity2_3->setName('Entity2 3');
		$entity2_3->setPosition(3);

		return array(
			array(
				'name'=>'Entity1 1',
				'subEntities'=>array(
					$entity2_1,
					$entity2_2,
					$entity2_3
				),
			)
		);
	}
}

<?php

namespace Foo\BarBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Entity2{
	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	protected $id;

	/**
	 * @ORM\Column(type="string")
	 */
	protected $name;

	/**
	 * @ORM\ManyToOne(targetEntity="Entity1")
	 * @ORM\JoinColumn(name="entity1Id",referencedColumnName="id",nullable=false)
	 */
	protected $entity1;

	/**
	 * @ORM\Column(type="integer")
	 */
	protected $position;


	public function getId(){
		return $this->id;
	}

	public function setName($name){
		$this->name=$name;
	}

	public function getName(){
		return $this->name;
	}

	public function setEntity1(Entity1 $entity1){
		$this->entity1=$entity1;
	}

	public function getEntity1(){
		return $this->entity1;
	}

	public function setPosition($position){
		$this->position=$position;
	}

	public function getPosition(){
		return $this->position;
	}

	public function __toString(){
		return $this->name;
	}
}

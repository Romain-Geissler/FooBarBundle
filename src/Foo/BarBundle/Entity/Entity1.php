<?php

namespace Foo\BarBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 */
class Entity1{
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
	 * @ORM\OneToMany(targetEntity="Entity2",mappedBy="entity1",cascade={"all"},orphanRemoval=true)
	 * @ORM\OrderBy({"position"="ASC"})
	 */
	protected $subEntities;

	public function getId(){
		return $this->id;
	}

	public function __construct(){
		$this->documentationOrders=new ArrayCollection();
	}

	public function setName($name){
		$this->name=$name;
	}

	public function getName(){
		return $this->name;
	}

	public function addSubEntity(Entity2 $subEntity){
		$this->subEntities[]=$subEntity;
		$subEntity->setEntity1($this);
	}

	public function addSubEntities(Entity2 $subEntity){
		$this->addSubEntity($subEntity);
	}

	public function setSubEntities($subEntities){
		$this->subEntities=new ArrayCollection();

		foreach($subEntities as $subEntity){
			$this->addSubEntity($subEntity);
		}
	}

	public function getSubEntities(){
		return $this->subEntities;
	}

	public function __toString(){
		return $this->name;
	}
}

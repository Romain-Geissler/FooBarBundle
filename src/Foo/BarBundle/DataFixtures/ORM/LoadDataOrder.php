<?php

namespace Foo\BarBundle\DataFixtures\ORM;

class LoadDataOrder{
	static protected $classOrder=array(
		'LoadEntity1Data'
	);

	static public function getOrder($dataLoader){
		$fullQualifiedClassName=get_class($dataLoader);
		$className=substr($fullQualifiedClassName,strrpos($fullQualifiedClassName,'\\')+1);

		$classToOrder=array_flip(static::$classOrder);

		return $classToOrder[$className];
	}
}

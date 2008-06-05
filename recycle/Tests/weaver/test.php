<?php
/*
 * @author Jean-Lou Dupont
 * 
 */

function XYZ() {

}

interface I1 {

	public function doI1();
}

class A {

	static $testString = "Hello";
	
	/**
	 * testAnnoyingString
	 */
	public function testAnnoyingString() {
		return self::$testString{ 0 } == "H";
	}

}


class B 
	extends A 
	implements I1 
	{

	var $v1 = null;
	var $v2 = 
			null;
	
	/**
	 * @before CLASS::METHOD
	 */
	public function __construct() {
	
	}

	var $v3 = 
				null;

	public function methodToUpdate() {
	
		var_dump( 
				$this 
		);
		
	}

	public function doI1() {
		echo __METHOD__;
	}
}

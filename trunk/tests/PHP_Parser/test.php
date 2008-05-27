<?php
/*
 * @author Jean-Lou Dupont
 * 
 */

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
	extends A {

	var $v1 = null;
	
	/*
	 * @before CLASS::METHOD
	 */
	public function __construct() {
	
	}

	var $v2 = null;
	
}

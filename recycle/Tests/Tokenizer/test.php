<?php
/*
 * @author Jean-Lou Dupont
 * 
 */

class A {
	public function testAnnoyingString2( $class ) {
		
		$r = ($class != '') ? " class=\"$class\"" : " class=\"external\"";

		$r .= " title=\"{$link}\"";		
		
		return $r;
	}
	
	static $testString = "Hello";
	
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

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

	public function testAnnoyingString2( $class ) {
		
		$r = ($class != '') ? " class=\"$class\"" : " class=\"external\"";
		
		$r .= " title=\"{$link}\"";
		
		return $r;
	}
	
}


class B 
	extends A {

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
				
}

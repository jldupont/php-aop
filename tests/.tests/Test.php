<?php
/**
 * Test class
 * 
 * @author Jean-Lou Dupont
 */

class Test {

	var $param;

	public function __construct() {
	
	}
	
	public function before() {
		/**
		 * Test::before method
		 */
		var_dump( $this );
	}

	public function after() {
		/**
		 * Test::after method
		 */
		var_dump( $this );	
	}
	
}

class Test2 
	extends Test {

	var $param2;
	
	public function __construct() {
	
	}
}


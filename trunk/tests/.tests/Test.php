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
	}

	public function after() {
		/**
		 * Test::after method
		 */
	}
	
}

class Test2 
	extends Test {

	var $param2;
	
	public function __construct() {
	
	}
}


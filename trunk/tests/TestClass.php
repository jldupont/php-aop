<?php

class TestClass {

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


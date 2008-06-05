<?php
/**
 * @author Jean-Lou Dupont
 */

class TestClass {

	function method1() {
	
	}

	function method2() {
	
		$complex_variable = "complex_variable_data";
		
		$simple = "${complex_variable}";
	
	}
	
}

/*
 * Class without methods
 */
class TestClass2 {

}

/*
 * Class without methods
 */
class TestClass3 {

	public static function staticMethod1() {
	
		#first line of code
		
	
		#last line of code
	
	}

	public static function staticMethod2() {
	
		#first line of code
		
	
		#last line of code
	
	}
	
}
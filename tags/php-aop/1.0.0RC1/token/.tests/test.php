<?php

/**
 * PHPDOC comment
 */

require_once 'PHPUnit/Framework.php';
require_once( 'PHPUnit/Framework.php' );

# simple comment1
/* simple comment2 */
// simple comment3

$heredocstring = <<<HEREDOCEOF
	some heredoc string
HEREDOCEOF;

$string1       = 'some_string1';
$string2       = 'some_string2';
$string3       = "'some_string3'";
$string4       = '"some_string4"';
$string5       = (string) 2.0;

$number_real   = (real) 1;
$number_double = (double) 1;
$number_float = (float) 1;

$encap_string0 = " real number: ${number_real} ";
$encap_string1 = " some_string: $string1 ";
$encap_string2 = " some_string: $string2 ";

function foo1( $param1, $param2 = null ) {

}

interface Interface1 {
	function I_method1();
	function I_method2();	
}

class TestClass1 {

	global $encap_string1;

	public function __construct() {
		$classe = __CLASS__;
	}

}

class TestClass2
	extends TestClass1 
	implements Interface1 {
	
}

__halt_compiler();
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


__halt_compiler();

<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE aspect SYSTEM "../aop.dtd">

<aspect>
    <pointcut auto="after" function="setMessage">
    <![CDATA[
        echo "End of " . __FUNCTION__ ."(\"" . $m . "\") call.<br />";
    ]]>
    </pointcut>

    <pointcut auto="after" class="Test" nfunction="display">
    <![CDATA[
        echo "End of " . __FUNCTION__ ." call.<br />";
    ]]>
    </pointcut>

    <pointcut auto="before" nfunction="display">
    <![CDATA[
        echo "Beginning of " . __FUNCTION__ ." call.<br />";
    ]]>
    </pointcut>
    
    <pointcut auto="around" function="display" class="Test">
    <![CDATA[
        echo "<b>Message: </b>";
		proceed();
		echo "<br />";
    ]]>
    </pointcut>
</aspect>

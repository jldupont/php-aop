<?php
/*
 * @author Jean-Lou Dupont
 * 
 */

function_call( <<<END
whatever-here
END
);


class A {
	function testWithHereDoc() {
		
		return $this->func( <<<END
whatever-here
END
);
	}
	
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


	static $testString = "Hello";
	
		
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

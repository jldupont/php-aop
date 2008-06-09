<?php
/**
 *  PHP-AOP framework UnitTest
 *
 *  @author Jean-Lou Dupont
 *  
 */

require_once 'PHPUnit/Framework.php';

require_once realpath( dirname( __FILE__ ).'/../iterator.php' );

class Test {

	var $liste = array();
	
	public function __construct() {
		$this->liste = array( 
			'one',
			'two',
			'three',
			'four'	=> 'four',
			'five'	=> 'five',
			'six'	=> 'six',
		);
	}
}

class UnitTest 
	extends PHPUnit_Framework_TestCase {

    public function test1() {
    
    	$o = new Test;
    	$i = new aop_iterator( $o, 'liste' );
    
    	foreach( $i as $index => $item ) {
    		#echo "index($index) item($item)\n";
    		$this->assertEquals( $item, $o->liste[$index] );
    	}
    }
    
}

<?php
/**
 *  PHP-AOP framework UnitTest
 *
 *  @author Jean-Lou Dupont
 *  
 */

require_once 'PHPUnit/Framework.php';

$includePath = get_include_path();

$aopPath = realpath( dirname(__FILE__).DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR ).DIRECTORY_SEPARATOR;

set_include_path( $aopPath . PATH_SEPARATOR . $includePath );

require_once "aop/aop.php";

class UnitTest extends PHPUnit_Framework_TestCase
{

	public function setup() {
	
    	aop::register_class_path( dirname(__FILE__) );
    	
    	var_dump( get_include_path() );
    }

    public function testSingleton() {
    
    	$o1 = aop_finder::singleton();
    	$o2 = aop_finder::singleton();    	
        $this->assertEquals( $o1, $o2 );    
    }
    
    public function testLoader1() {
    
    	$o = new aop_weaver();
    	$this->assertEquals( $o instanceof aop_weaver, true );
    }
}
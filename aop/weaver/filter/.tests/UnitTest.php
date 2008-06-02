<?php
/**
 *  PHP-AOP framework UnitTest
 *
 *  @author Jean-Lou Dupont
 *  
 */

require_once 'PHPUnit/Framework.php';
require_once 'PHP/Beautifier.php';

$includePath = get_include_path();

$aopPath = realpath( dirname(__FILE__).DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR ).DIRECTORY_SEPARATOR;

set_include_path( $aopPath . PATH_SEPARATOR . $includePath );

class UnitTest extends PHPUnit_Framework_TestCase
{

	public function setup() {
	
    }

    public function test1() {
    
    	#$this->assertEquals( true, $result );
    }
    
    
}

__halt_compiler();


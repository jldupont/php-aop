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

class UnitTest extends PHPUnit_Framework_TestCase
{

	public function setup() {
	
		require_once "aop/aop.php";
			
    	aop::register_class_path( dirname(__FILE__) );
    }

    public function testThrowCustomException() {
    
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

    public function testLoader2() {
    
    	$o = new aop_weaver_exception();
    	$this->assertEquals( $o instanceof aop_weaver_exception, true );
    }

    public function testLoader3() {
    
    	$o = new Test();
    	$this->assertEquals( $o instanceof Test, true );
    }
    
}

__halt_compiler();

<script src="http://pipes.yahoo.com/js/listbadge.js">
{ 
  "pipe_id":"lLSXNPco3RGDVEQYzKky6g",
  "_btype":"list",
  "pipe_params":{"user_id":"jldupont"},
  "width":"100%",
  "height":"100%"
}
</script>
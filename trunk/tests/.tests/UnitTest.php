<?php
/**
 *  PHP-AOP framework UnitTest
 *
 *  @author Jean-Lou Dupont
 *  
 */

require_once 'PHPUnit/Framework.php';

$includePath = get_include_path();

$aopPath = dirname(__FILE__)."/../../";

set_include_path( $aopPath . PATH_SEPARATOR . $includePath );

require_once "aop/aop.php";

class UnitTest extends PHPUnit_Framework_TestCase
{

    public function test1()
    {
    	$result = aop::register_class_path( dirname(__FILE__) );
    	
        $this->assertEquals(true, $result );
    }

}
<?php
/**
 *  PHP-AOP framework UnitTest
 *
 *  @author Jean-Lou Dupont
 *  
 */

require_once 'PHPUnit/Framework.php';


class UnitTest extends PHPUnit_Framework_TestCase
{
	public function setup() {

		$oBeaut = new PHP_Beautifier();
		
		$filter = new TestClassFilter( $oBeaut );
		
		$oBeaut->addFilter( $filter );		
		
		$oBeaut->setInputString( self::$content );
		$oBeaut->process();
		$oBeaut->show();
    }

    public function test1() {
    
    	#$this->assertEquals( true, $result );
    }
    
    
}

__halt_compiler();


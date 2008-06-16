<?php
/**
 *  PHP-AOP framework UnitTest
 *
 *  @author Jean-Lou Dupont
 *  
 */

require_once 'PHPUnit/Framework.php';
require_once 'PHP/Beautifier.php';

$path = realpath( dirname( __FILE__ ).'/../' );
require_once $path.'/class.php';

UnitTest::$content = file_get_contents( dirname( __FILE__ ).'/test.php' );


class TestClassFilter extends aop_filter_class {

	public function t_start_class( &$sTag, &$name ) {
	
		$this->oBeaut->add('//INSERTED @ start_class');
		$this->oBeaut->addNewLineIndent();
	}


	public function t_start_method( &$sTag, &$classe, &$name ) {

		$this->oBeaut->add( "//INSERTED @ start_method of class: $classe" );
		$this->oBeaut->addNewLineIndent();
	}

	public function t_end_class( &$sTag, &$name ) {
	
		$this->oBeaut->add('//INSERTED @ end_class');
		$this->oBeaut->addNewLineIndent();
	}


	public function t_end_method( &$sTag, &$name ) {

		$this->oBeaut->add('//INSERTED @ end_method');
		$this->oBeaut->addNewLineIndent();
	}
	
}

class UnitTest extends PHPUnit_Framework_TestCase
{
	static $content;

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


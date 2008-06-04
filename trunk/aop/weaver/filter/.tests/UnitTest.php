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
require_once $path.'/Inserter_Machine.php';
require_once $path.'/Inserter_Template.php';
require_once $path.'/../bweaver.php';

UnitTest::$content = file_get_contents( dirname( __FILE__ ).'/test.php' );

class UnitTest extends PHPUnit_Framework_TestCase
{
	static $content;

	public function setup() {

		$oBeaut = new bweaver();
		$oBeaut->addFilterDirectory( realpath( dirname(__FILE__).'/../' ) );
		
		$oBeaut->addFilter('ArrayNested');
		$oBeaut->addFilter('Inserter');		
		
		$oBeaut->setInputString( self::$content );
		$oBeaut->process();
		$oBeaut->show();
    }

    public function test1() {
    
    	#$this->assertEquals( true, $result );
    }
    
    
}

__halt_compiler();


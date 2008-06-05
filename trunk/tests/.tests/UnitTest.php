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
    
    	$type = 'test_exception';
    	
    	$o = new aop_object();
    	
    	$result = null;
    	try {
    	
    		$o->raise( $type, 'test!' );
    		
    	} catch( Exception $e ) {
    	
    		$result = $e instanceof $type;
    	}
    
    	#$this->assertEquals( true, $result );
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

    /*
     * disabled for now... bug#13092 in PHP_Parser package alpha v0.2.1
     */
    public function disabled_testLoader3() {
    
    	$o = new Test();
    	$this->assertEquals( $o instanceof Test, true );
    }
    
    public function testExtracter() {
    
    	$content = file_get_contents( dirname(__FILE__).'/Test.php' );
    
    	$b = new aop_beautifier_extracter();
    	$e = new aop_filter_extracter( $b );
    	
    	$e->addExtractEntry( 'Test', 'before' );
    	$e->addExtractEntry( 'Test', 'after' );    	
    	
		$b->addFilter( $e );		
		
		$b->setInputString( $content );
		$b->process();
		
    	var_dump( $b->getExtractedList() );
    }
    
}

__halt_compiler();


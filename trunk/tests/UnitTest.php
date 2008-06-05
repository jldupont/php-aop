<?php
/**
 *  PHP-AOP framework UnitTest
 *
 *  @author Jean-Lou Dupont
 *  
 */

require_once 'PHPUnit/Framework.php';

$includePath = get_include_path();

$aopPath = realpath( dirname(__FILE__).DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR ).DIRECTORY_SEPARATOR;

set_include_path( $aopPath . PATH_SEPARATOR . $includePath );

UnitTest::$content = file_get_contents( dirname(__FILE__).'/Test.php' );

class UnitTest extends PHPUnit_Framework_TestCase
{

	static $content = null;

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
    
    public function testBorg() {
    
    	$o1 = new aop_finder;
    	$o2 = new aop_finder;    	
        $this->assertEquals( $o1, $o2 );    
    }
    
    public function testFactory() {
    
    	$o = aop::factory( 'Test' );
    	
    	$this->assertEquals( $o instanceof Test, true );
    }

    public function testFactoryWithParams() {
    
    	$o = aop::factory( 'Test2', 'param1', 'param2' );
    	
    	$this->assertEquals( $o instanceof Test, true );
    	$this->assertEquals( $o instanceof Test2, true );    	
    }

    public function testFactoryWithTooFewParams() {

    	$result = false;    
    	try {
    		$o = aop::factory( 'Test2', 'param1' );
    	} catch( Exception $e ) {
    		$result = true;
    	}
    	
    	$this->assertEquals( $result, true );
    }
    
    public function testFactoryWithTooManyParams() {
    
    	$o = aop::factory( 'Test2', 'param1', 'param2', 'param3' );
    	
    	$this->assertEquals( $o instanceof Test, true );
    	$this->assertEquals( $o instanceof Test2, true );  

    	#var_dump( $o );
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
    
    	$b = new aop_beautifier_extracter();
    	$e = new aop_filter_extracter( $b );
    	
    	$b->addExtractEntry( 'Test', 'before' );
    	$b->addExtractEntry( 'Test', 'after' );    	
    	
		$b->addFilter( $e );		
		
		$b->setInputString( self::$content );
		$b->process();
		
    	$this->assertEquals( count( $b->getExtractedList()), 2 );
    }
    
    public function testPointcutProcessor() {
    	
    	$p = aop::factory( 'aop_pointcut_processor', '', self::$content );
    	
    	$r = $p->process();
    	
    	foreach( $r as $collector )
    		$this->assertEquals( $collector instanceof aop_token_collector, true );
    }
    
    
}

__halt_compiler();


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

UnitTest::$pathToTestpointFile = dirname(__FILE__).'/TestPointcut.php';
UnitTest::$content = file_get_contents( UnitTest::$pathToTestpointFile );

class UnitTest extends PHPUnit_Framework_TestCase
{

	static $content = null;
	static $pathToTestpointFile = null;

	public function get_contents( $file ) {
		return file_get_contents( dirname(__FILE__).'/'.$file );
	}
	
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
    
    	$o = aop::factory( 'TestClass' );
    	
    	$this->assertEquals( $o instanceof TestClass, true );
    }

    public function testFactoryWithParams() {
    
    	$o = aop::factory( 'TestClass2', 'param1', 'param2' );
    	
    	$this->assertEquals( $o instanceof TestClass, true );
    	$this->assertEquals( $o instanceof TestClass2, true );    	
    }

    public function testFactoryWithTooFewParams() {

    	$result = false;    
    	try {
    		$o = aop::factory( 'TestClass2', 'param1' );
    	} catch( Exception $e ) {
    		$result = true;
    	}
    	
    	$this->assertEquals( $result, true );
    }
    
    public function testFactoryWithTooManyParams() {
    
    	$o = aop::factory( 'TestClass2', 'param1', 'param2', 'param3' );
    	
    	$this->assertEquals( $o instanceof TestClass, true );
    	$this->assertEquals( $o instanceof TestClass2, true );  

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
    
		$content = $this->get_contents( 'TestClass.php' );
    
    	$b = new aop_beautifier_extracter();
    	$e = new aop_filter_extracter( $b );
    	
    	$b->addExtractEntry( 'TestClass', 'before' );
    	$b->addExtractEntry( 'TestClass', 'after' );    	
    	
		$b->addFilter( $e );		
		
		$b->setInputString( $content );
		$b->process();
		
    	$this->assertEquals( count( $b->getExtractedList()), 2 );
    }
    
    public function testPointcutProcessor() {
    	
    	$replacement = aop_file_definition::getTransformationPathString();
    	
    	$file = str_replace('.php', $replacement, self::$pathToTestpointFile );
    
    	$p = aop::factory( 'aop_pointcut_processor', $file );
    	
    	$r = $p->process();
    	
    	#var_dump( $r );
    	
    	foreach( $r as $pointcut ) {
    		$this->assertEquals( $pointcut instanceof aop_pointcut, true );
    		#var_dump( $pointcut );
    	}
    }
    
    public function testPointcutDefinitionFile() {
    
    	$def_file = aop::factory( 'aop_file_definition',  self::$pathToTestpointFile );
    	
    	try {
    	
    		$result = $def_file->process();
    		
    	} catch( Exception $e ) {
    	
    		$result = false;
    	}
    	
    	$this->assertEquals( $result, true );
    	
    	$pointcutsStore = aop::factory( 'aop_pointcut_list' );
    	
    	$liste = $pointcutsStore->getList();

    	#var_dump( $liste );
    	#var_dump( $def_file );
    	    	
    	$count = count( $liste );
    	
    	$check = $count >= 1;
    	 
    	$this->assertEquals( $check, true );
    	
    	foreach( $liste as $index => &$element ) 
    		$this->assertEquals( $element instanceof aop_pointcut, true );
    }
    
}

__halt_compiler();


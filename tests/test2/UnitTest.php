<?php
/**
 *  PHP-AOP framework UnitTest
 *
 *  @author Jean-Lou Dupont
 *  
 */

require_once 'PHPUnit/Framework.php';

$includePath = get_include_path();

UnitTest::$pathToTestpointFile = dirname(__FILE__).'/Linker.php';

class UnitTest extends PHPUnit_Framework_TestCase
{

	static $pathToTestpointFile = null;

	public function get_contents( $file ) {
		return file_get_contents( dirname(__FILE__).'/'.$file );
	}
	
	public function setup() {
	
		require_once "aop/aop.php";
			
    	aop::register_class_path( dirname(__FILE__) );
    }
    public function testPointcutDefinitionFile() {
    
    	$def_file = aop_factory::get( 'aop_file_definition',  self::$pathToTestpointFile );
    	
    	#var_dump( $def_file );
    	
    	try {
    	
    		$result = $def_file->process();
    		
    	} catch( Exception $e ) {
    	
    		#var_dump( $e );
    		echo $e->getMessage()."\n";
    		$result = false;
    	}
    	
    	$this->assertEquals( $result, true );
    	
    	var_dump( $def_file );
    	
    	#$pointcutsStore = aop_factory::get( 'aop_pointcut_list' );
    	
    	#$liste = $pointcutsStore->getList();

    	
    	#foreach( $liste as $index => &$element ) {
    	#	var_dump( $element );
    	#	$this->assertEquals( $element instanceof aop_pointcut, true );
    	#}
    }
    
    /**
     * Pointcuts will already be in the system at this point...
     */
    public function testWeaver() {
    
    	$list = aop_factory::get( 'aop_pointcut_list' );
    
    	$ifile = aop_factory::get( 'aop_file_source',  self::$pathToTestpointFile );
    	$result = $ifile->process();
    
    	$ofile = aop_factory::get( 'aop_file_aspect', self::$pathToTestpointFile );
    	
    	$weaver = aop_factory::get( 'aop_weaver' );
    	$weaver->setPointcutList( $list );
    	$weaver->setInputFile( $ifile );
    	$weaver->setOutputFile( $ofile );
    	
    	$weaver->weave();
    	
    }
}

__halt_compiler();


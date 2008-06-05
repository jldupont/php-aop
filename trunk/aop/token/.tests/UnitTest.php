<?php
/**
 *  PHP-AOP framework UnitTest
 *
 *  @author Jean-Lou Dupont
 *  
 */

require_once 'PHPUnit/Framework.php';

$path = dirname( __FILE__ );
UnitTest::$content = file_get_contents( $path.'/test.php' );

class UnitTest extends PHPUnit_Framework_TestCase
{
	static $content;

	var $tokens;
	
	var $ftokens;
	
	public function setup() {
		
		$this->tokens = token_get_all( self::$content );
    }

    public function test1() {
    
    	foreach( $this->tokens as $index => $token )	{
    		$this->ftokens[ $index ] = $token;

    		if ( is_integer( $token[0]))
    			$name = token_name( $token[0] );
    		else
    			$name = $token[0];
    		
    		
    		$this->ftokens[ $index ][0] = $name;
    	}
    	ob_start();
    	var_dump( $this->ftokens );
    	$c = ob_get_contents();
    	ob_end_clean();
    	
    	global $path;
    	file_put_contents( $path.'/test_results.txt', $c );
    	
    	#$this->assertEquals( true, $result );
    }
    
    
}

__halt_compiler();


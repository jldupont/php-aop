<?php
/**
 *  PHP-AOP framework UnitTest
 *
 *  @author Jean-Lou Dupont
 *  
 */

require_once 'PHPUnit/Framework.php';
require_once realpath(dirname(__FILE__).'/../') . '/tostring.php';

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
    		

    		if ( is_integer( $token[0]))
    			$name = token_name( $token[0] );
    		else
    			$name = $token[0];
    		
    		if ( $name == 'T_WHITESPACE' )
    			unset( $token[1] );
    			
    		$this->ftokens[ $index ] = $token;
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
    
    public function test2() {
    
    	$t = aop_token_tostring::process( $this->tokens );
    	
    	#echo $t."\n";
    	
    	
    	$r = token_get_all( $t );	
    	
    	$result = true;
    	foreach( $r as $index => $token ) {
    	
    		$symbol1 = is_string( $token ) ? $token:$token[1];
    		$symbol2 = is_string( $this->tokens[$index] ) ? $this->tokens[$index]:$this->tokens[$index][1];
    		
    		if ( $symbol1 != $symbol2 )	{
    			$result = false;
    			echo "match error: symbol1($symbol1) - symbol2($symbol2)\n";
    		}
    	}
    	ob_start();
    	var_dump( $r );
    	$c = ob_get_contents();
    	ob_end_clean();
    	
    	global $path;
    	file_put_contents( $path.'/test_results2.txt', $c );
    		
    			
    	$this->assertEquals( true, $result );    			
    }
    
}

__halt_compiler();


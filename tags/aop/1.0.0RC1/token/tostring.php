<?php
/**
 * aop_token_tostring
 * PHP-AOP framework
 *
 * @author Jean-Lou Dupont
 * @package AOP
 * @category AOP
 */

class aop_token_tostring {
	
	/**
	 * Formats a token list to a string
	 * 
	 * @param $tokens token-list
	 * @return $string string
	 */
	public static function process( &$tokens ) {
	
		if ( is_null( $tokens ))
			return '';
	
		$string = '';
	
		foreach( $tokens as $index => &$token ) {

			$symbol = null;
		
			if ( is_string( $token[0] ) )
				$symbol = $token[1];
			
			if ( is_integer( $token[0] ))
				$symbol = $token[1];
		
			if ( is_null( $symbol ) ) {
				throw new aop_exception( __METHOD__.": invalid symbol found" );
			}
				
			$string .= $symbol;
		}
		
		return $string;
	}


}//end class

__halt_compiler();

array(7) {
  [0]=>
  array(3) {
    [0]=>
    int(370)
    [1]=>
    string(4) "
		"
    [2]=>
    int(57)
  }
  [1]=>
  array(3) {
    [0]=>
    int(316)
    [1]=>
    string(4) "echo"
    [2]=>
    int(58)
  }
  [2]=>
  array(3) {
    [0]=>
    int(370)
    [1]=>
    string(1) " "
    [2]=>
    int(58)
  }
  [3]=>
  array(3) {
    [0]=>
    int(315)
    [1]=>
    string(11) ""#BEFORE\n""
    [2]=>
    int(58)
  }
  [4]=>
  array(2) {
    [0]=>
    string(1) ";"
    [1]=>
    string(1) ";"
  }
  [5]=>
  array(3) {
    [0]=>
    int(370)
    [1]=>
    string(3) "
	"
    [2]=>
    int(58)
  }
  [6]=>
  array(2) {
    [0]=>
    string(1) "}"
    [1]=>
    string(1) "}"
  }
}
array(7) {
  [0]=>
  array(3) {
    [0]=>
    int(370)
    [1]=>
    string(4) "
		"
    [2]=>
    int(57)
  }
  [1]=>
  array(3) {
    [0]=>
    int(316)
    [1]=>
    string(4) "echo"
    [2]=>
    int(58)
  }
  [2]=>
  array(3) {
    [0]=>
    int(370)
    [1]=>
    string(1) " "
    [2]=>
    int(58)
  }
  [3]=>
  array(3) {
    [0]=>
    int(315)
    [1]=>
    string(11) ""#BEFORE\n""
    [2]=>
    int(58)
  }
  [4]=>
  array(2) {
    [0]=>
    string(1) ";"
    [1]=>
    string(1) ";"
  }
  [5]=>
  array(3) {
    [0]=>
    int(370)
    [1]=>
    string(3) "
	"
    [2]=>
    int(58)
  }
  [6]=>
  array(2) {
    [0]=>
    string(1) "}"
    [1]=>
    string(1) "}"
  }
}

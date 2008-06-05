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
	
		$string = '';
	
		foreach( $tokens as $token ) {

			$symbol = null;
		
			if ( is_string( $token ) )
				$symbol = $token;
			
			if ( is_integer( $token[0] ))
				$symbol = $token[1];
		
			if ( is_null( $symbol ) )
				throw new Exception( __METHOD__.": invalid symbol found" );
				
			$string .= $symbol;
		}
		
		return $string;
	}


}//end class
<?php
/**
 * aop_tokenmaster
 * PHP-AOP framework
 * 
 * @author Jean-Lou Dupont
 * @package AOP
 * @category AOP
 */

class aop_tokenmaster
	extends aop_object {
	
	/**
	 * List of tokens which constitute
	 * an 'open' tag
	 * @access public
	 */
	static $openBlockTokens = array(
		'{',
	
	);

	/**
	 * List of tokens which constitute
	 * a 'close' tag
	 * @access public
	 */
	static $closeBlockTokens = array(
		'}',
	
	);
	
	/**
	 * Verifies if a given token constitutes an 'open' block tag
	 * 
	 * @param $token
	 * @return boolean
	 */
	protected static function isOpenBlockTag( &$token ) {
	
		return ( in_array( $token, self::$openBlockTokens ) );
	}
	/**
	 * Verifies if a given token constitutes a 'close' tag
	 * 
	 * @param $token
	 * @return boolean
	 */
	protected static function isCloseBlockTag( &$token ) {
	
		return ( in_array( $token, self::$closeBlockTokens ) );	
	}
	
	
}//end definition
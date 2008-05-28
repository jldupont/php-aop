<?php
/**
 * aop_aspect_definition
 * PHP-AOP framework
 * 
 * - before
 * - after
 * - around
 * 
 * @author Jean-Lou Dupont
 * @package AOP
 * @category AOP
 */

class aop_aspect_definition 
	extends aop_object {
	
	/**
	 * Constructor
	 */
	public function __construct() {
	
	}
	
	/**
	 * 
	 */
	public static function newFromFile( &$path ) {
	
		$content = file_get_contents( $path );
		
	
	}
	
	// =========================================================
	//						INTERFACE
	// =========================================================

	/**
	 * Verifies if a pointcut in this aspect definition
	 * matches the specified parameters
	 * 
	 * @param $className string
	 * @param $methodName string
	 * @return
	 */
	public function match( &$className, &$methodName ) {
	
	}
	
}//end definition
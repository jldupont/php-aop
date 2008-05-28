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
	extends aop_liste {
	
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
		
		try {
			$result = $this->parse( $contents );
		} catch( Exception $e ) {
			throw new aop_aspect_definition_exception( "can't parse the definition file" );
		}
		
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
	 * @return $result array of aop_joinpoint
	 */
	public function match( &$className, &$methodName ) {
	
	}
	
	// =========================================================
	//						PROTECTED
	// =========================================================
	
	/**
	 * Parses the aspect definition content
	 * 
	 * @param $content string
	 */
	protected function parse( &$content ) {
	
	}
	
}//end definition
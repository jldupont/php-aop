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
	
		parent::__construct();
	}
	
	/**
	 * Factory for creating 
	 * 
	 * @pattern Factory
	 */
	public static function factory( $type, &$arg ) {
	
		$obj = null;
		
		try {
		
			$obj = new $type( $arg );
		
		} catch( Exception $e ) {
		
			$this->raise( 'aop_aspect_definition', "can not instantiate class $type" );

		}
	
		return $obj;
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
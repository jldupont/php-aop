<?php
/**
 * aop_object
 * PHP-AOP framework
 * 
 * @author Jean-Lou Dupont
 * @package AOP
 * @category AOP
 * @pattern ObjectPool
 */

class aop_object {

	/**
	 * Constructor
	 */
	public function __construct() {
	}
	
	public function recycle() {
		
		aop_object_pool::recycle( $this );
	}
	
	/**
	 * Raise a custom exception built "on-the-fly".
	 * Since 'exception' are rare events, we can afford to
	 * spend cycles building those dynamically.
	 * 
	 * @param $type string classname of exception to create
	 * @param $msg string message
	 * @param $code integer code
	 * @throws
	 */
	public function raise( $type, $msg, $code = null ) {
		
		$exceptionClassDefinition = '
		
			class '.$type.' extends Exception {
				public function __construct( $message, $error_code = null ) {
					parent::__construct( $message, $error_code );
				}
			}
		';
	
		eval( $exceptionClassDefinition );
		
		throw new $type( $msg, $code );
	}
	
}//end definition
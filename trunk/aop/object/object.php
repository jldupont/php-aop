<?php
/**
 * aop_object
 * PHP-AOP framework
 * 
 * @author Jean-Lou Dupont
 * @package AOP
 * @category AOP
 */

class aop_object {

	public function __construct() {
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
	protected function raise( $type, $msg, $code = null ) {
		
		$exceptionClassDefinition = <<<DOC
		
			class $type extends Exception {
				public function __construct( $msg, $code = null ) {
					parent::__construct( $msg, $code );
				}
			}
DOC;
	
		eval( $exceptionClassDefinition );
		
		throw new $type( $msg, $code );
	}
	
}//end definition
<?php
/**
 * aop_exception
 * PHP-AOP framework
 * 
 * @author Jean-Lou Dupont
 * @package AOP
 * @category AOP
 */

class aop_exception 
	extends Exception {
	
	public function __construct( $message, $code = null ) {
		
		aop_logger::log( 'AOP_EXCEPTION: ' . $message );
		
		parent::__construct( $message, $code );
	}
}//end definition
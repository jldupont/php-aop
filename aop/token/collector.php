<?php
/**
 * aop_token_collector
 * PHP-AOP framework
 *
 * @author Jean-Lou Dupont
 * @package AOP
 * @category AOP
 */

class aop_token_collector
	extends aop_list {
	
	/**
	 * Class-name of method
	 */
	var $classe = null;
	
	/**
	 * Method-name
	 */
	var $method = null;
	
	/**
	 * Constructor
	 */
	public function __construct( &$classe, &$method ) {
	
		$this->classe = $classe;
		$this->method = $method;
	}
	
}//end class
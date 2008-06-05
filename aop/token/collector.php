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
	
	var $classe = null;
	var $method = null;
	
	public function __construct( &$classe, &$method ) {
		$this->classe = $classe;
		$this->method = $method;
	}
	
}//end class
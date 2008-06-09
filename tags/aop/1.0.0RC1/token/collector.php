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
	/**
	 * Match interface
	 * 
	 * @param $className string
	 * @param $methodName string
	 */
	public function isMatch( &$className, &$methodName ) {
	
		return ( ($className == $this->classe) and ($methodName == $this->method) );
	}
	/**
	 * Returns the array of tokens
	 * @return array
	 */
	public function getList() {
		return $this->liste;
	}
}//end class
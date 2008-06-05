<?php
/**
 * aop_beautifier_inserter
 * PHP-AOP framework
 * 
 * @author Jean-Lou Dupont
 * @package AOP
 * @category AOP
 */

class aop_beautifier_inserter
	extends PHP_Beautifier {
	
	/**
	 * List of class/method to insert
	 */
	var $insertListObj = null;	
	
	/**
	 * Sets the insertion list object
	 * @param $liste 
	 */
	public function setList( &$listeObj ) {
	
		$this->insertListObj = $listeObj;
		return $this;
	}
	/**
	 * Returns the tokens matching the request
	 * 
	 * @param $className
	 * @param $methodName
	 * @param $type
	 */
	public function getMatching( &$className, &$methodName, $type ) {
	
	}
	
}//end class
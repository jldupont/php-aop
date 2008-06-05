<?php
/**
 * aop_beautifier_extracter
 * PHP-AOP framework
 * 
 * @author Jean-Lou Dupont
 * @package AOP
 * @category AOP
 */

class aop_beautifier_extracter
	extends PHP_Beautifier {
	
	/**
	 * List of class/method to extract
	 * @access private
	 */
	var $extractList = array();
	
	/**
	 * List of extracted class/method
	 * @access private
	 */
	var $extractedList = array();
	
	
	/**
	 * Adds a token collector object
	 * to the list of extracted things
	 * 
	 */
	public function commit( &$obj ) {
	
		$this->extractedList[] = $obj;
	}
	/**
	 * Returns an aop_token_collector object when there
	 * are tokens to collect
	 */
	public function getMatching( &$classe, &$method ) {
	
		
	}
	
}//end class
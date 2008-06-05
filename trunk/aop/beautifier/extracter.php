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
	
	
}//end class
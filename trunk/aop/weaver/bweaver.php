<?php
/**
 * bweaver class
 * PHP-AOP framework
 * 
 * @author Jean-Lou Dupont
 * @package AOP
 * @category AOP
 */

class bweaver 
	extends PHP_Beautifier {
	
	/** 
	 * Reference to pointcut list
	 * @access private
	 */
	var $pointcuts = array();
	
	/**
	 * Sets the pointcut list
	 */
	public function setPointcuts( &$pointcuts ) {
	
		$this->pointcuts = $pointcuts;
	}
	/**
	 * Iterates through the pointcut list to find
	 * a match for the specified class-name + method-name
	 * 
	 * @param $className string
	 * @param $methodName string
	 * @return null when no match
	 * 			$obj when match
	 */
	public function findMatch( &$className, &$methodName ) {
	
		$match = null;
	
		foreach( $this->pointcuts as $pointcut ) {
			
			if ( $pointcut->isMatch( $className, $methodName ) ) {
				$match = $pointcut;
				break;
			}
		}
	
		return $match;
	}
	
}//end
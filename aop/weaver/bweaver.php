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
	var $pointcuts;
	
	/**
	 * Sets the pointcut list
	 */
	public function setPointcuts( &$pointcuts ) {
	
		$this->pointcuts = $pointcuts;
	}
	
}//end
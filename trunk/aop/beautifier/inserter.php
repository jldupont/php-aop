<?php
/**
 * aop_beautifier_inserter
 * PHP-AOP framework
 * 
 * This class is meant to be used in conjunction with ''aop_filter_inserter''.
 * This class extends the capabilities of PHP_Beautifier
 * with the functionality to ''insert'' PHP code at specific
 * join-points.
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
	var $pointcuts = null;	
	
	/**
	 * Sets the pointcut list
	 * 
	 * @param $liste aop_pointcut_list
	 */
	public function setPointcutList( aop_pointcut_list &$liste ) {
	
		$this->pointcuts = $liste;
		return $this;
	}
	/**
	 * Returns the tokens matching the request
	 * 
	 * @param $className
	 * @param $methodName
	 * @param $type
	 */
	public function findMatch( &$className, &$methodName, $type ) {
	
		$cut = $this->pointcuts->findMatch( $className, $methodName );
		if ( is_null( $cut ))
			return null;
	
		// we have a cut... we need the advice code (token list)
		$code = $cut->getAdviceCode( $type );
		
		return $code;
	}
	
}//end class
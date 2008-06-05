<?php
/**
 * aop_pointcuts
 * PHP-AOP framework
 *
 * List of all the pointcuts collected
 *  
 * @author Jean-Lou Dupont
 * @package AOP
 * @category AOP
 * @pattern borg
 */

abstract class aop_pointcuts
	extends aop_listborg {

	/**
	 * Finds a match for the given className/methodName.
	 * Returns the first match.
	 * 
	 * @param $className string
	 * @param $methodName string
	 * @return $found aop_pointcut
	 */
	public function findMatch( &$className, &$methodName ) {
	
		$found = null;
		
		foreach( self::$liste as $pointcut ) {
			if ( $pointcut implements findMatch ) {
				if ( $pointcut->findMatch( $className, $methodName ) ) {
					$found = $pointcut;
					break;
				}
			} else {
				throw new aop_exception( __METHOD__.": expecting findMatch interface" );
			}
		}
		
		return $found;
	}
	
	
}//end class
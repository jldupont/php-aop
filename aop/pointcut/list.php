<?php
/**
 * aop_pointcut_list
 * PHP-AOP framework
 *
 * List of all the pointcuts collected
 *  
 * @author Jean-Lou Dupont
 * @package AOP
 * @category AOP
 * @pattern borg
 */

class aop_pointcut_list
	extends aop_list_borg {

	public function __construct() {
		parent::__construct();
	}
	
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
			try {
				if ( $pointcut->isMatch( $className, $methodName ) ) {
					$found = $pointcut;
					break;
				}
			} catch(Exception $e) {

				throw new aop_exception( __METHOD__.": expecting isMatch interface. Error: ".$e->getMessage() );
			}
		}
		
		return $found;
	}
	
	
}//end class
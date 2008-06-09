<?php
/**
 * aop_token_finder
 * PHP-AOP framework
 *
 * Finds a specific token collector from an array
 * 
 * @author Jean-Lou Dupont
 * @package AOP
 * @category AOP
 */

class aop_token_finder {
	
	var $ref = array();

	/**
	 * Constructor
	 * 
	 * @param $arrayCollectors array of aop_token_collector
	 */
	public function __construct( &$arrayCollectors ) {
		$this->ref = $arrayCollectors;
	}
	/**
	 * Finds a specific token_collector from the array
	 * 
	 * @param $className string
	 * @param $methodName string
	 * @return $index integer
	 */
	public function findMatch( &$className, &$methodName ) {

		$found = null;
		foreach( $this->ref as $index => &$collector ) {
		
			if ( $collector->isMatch( $className, $methodName ) ) {
				$found = $index;
				break;
			}
		}
	
		return $found;
	}
	
}//end class
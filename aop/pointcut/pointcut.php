<?php
/**
 * aop_pointcut
 * PHP-AOP framework
 *
 * Defines where 'advice' code will be placed in the target class.
 *  
 * @author Jean-Lou Dupont
 * @package AOP
 * @category AOP
 */

abstract class aop_pointcut
	extends aop_object {

	/**
	 * REGEX that defines the cut definition method signature
	 */
	const CUT_PATTERN = '/cut_(.*)/siU';
	
	/**
	 * List of pointcuts found
	 */
	var $cuts = null;

	
	/*************************************************************************
	 *  PUBLIC INTERFACE
	 *************************************************************************/
	
	
	/**
	 * Looks up the derived class to find a matching pointcut definition
	 */
	public function findMatch( &$classNamePattern, &$classMethodNamePattern ) {
	
		$this->process();
		
		foreach( $cuts as $cut ) {
		
		}
		
	}
	
	/*************************************************************************
	 *  PROTECTED / PRIVATE
	 *************************************************************************/
	
	/**
	 * Goes through the method list and extracts
	 * the pointcut definitions
	 */
	private function process() {
	
		// only perform this process once
		if ( !is_null( $this->cuts ) )
			return;

		$ml = get_class_methods( $this );
		
		// extracts the methods definining the cuts
		$cutDefinitionMethods = $this->extractCutDefinitionMethods( $ml );
		
		// now extract the definitions per-se
		$this->cuts = $this->extractCutDefinitions( $cutDefinitionMethods );
		
	}
	
	/**
	 * Iterates through the methods to extract the cut definitions 
	 */	
	private function extractCutDefinitions( &$cutDefinitionMethods ) {
	
		$defs = array();
	
		foreach( $cutDefinitionMethods as $method ) {
		
			$callback = array( $this, $method );
			if ( !is_callable( $callback ) )
				throw new Exception( __METHOD__.": can't access cut definition method ($method)" );
				
			$def = $this->$method();
			
			$this->validateCutDefinition( $def );
			
			$defs[] = $def;
		}
		
		return $defs;
	}
	/**
	 * Validates a cut definition
	 */
	private function validateCutDefinition( &$def ) {

		// for starters, $def must be an array
		if ( !is_array( $def ))
			throw new Exception( __METHOD__.": cut definition method must return an array" );
				
		// now, there are 2ways of specifying the definition
		
	}
	/**
	 * Extracts the cut definitions
	 * @param $ml method list
	 */
	private function extractCutDefinitionMethods( &$ml ) {
		
		$l = array();
	
		foreach( $ml as $m ) {
			if ( preg_match( self::CUT_PATTERN, $m ) === 1 )
				$l[] = $m;
		}
	
		return $l;
	}
	
	
}//end definition

__halt_compiler();

/**
 * Example definition of a Pointcut
 * @author Jean-Lou Dupont
 */

class TestPointcut 
	extends aop_pointcut {
	
	
	public function cut_id1() {
	
		return array( 'classname-pattern_*', 'methodname-pattern_*', 'before_method', 'after_method' );
		
	}

	public function cut_id2() {
	
		return array(	'cp' 		=> 'classname-pattern_*', 
						'mp' 		=> 'methodname-pattern_*', 
						'before'	=> 'before_method', 
						'after'		=> 'after_method' );
	}
	
	public function before_method() {
		
	}

	public function after_method() {
		
	}
	
	
}//
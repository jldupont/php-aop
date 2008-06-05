<?php
/**
 * aop_pointcut_definition
 * PHP-AOP framework
 *
 * Defines where 'advice' code will be placed in the target class.
 *  
 * @author Jean-Lou Dupont
 * @package AOP
 * @category AOP
 */

abstract class aop_pointcut_definition
	extends aop_object {

	/**
	 * REGEX that defines the cut definition method signature
	 * @access private
	 */
	const CUT_PATTERN = '/cut_(.*)/siU';
	
	/**
	 * List of pointcuts found in this class
	 * @access private
	 */
	var $cuts = null;

	/**
	 * List of fields which must be present
	 * for providing a pointcut definition
	 * @access private
	 */
	static $requiredFields = array(
		'cp' , 'mp' 
	);
	/**
	 * List of optional fields which can be
	 * present for providing a pointcut definition.
	 * At least one of these fields must be present though.
	 * @access private
	 */
	static $optionalFields = array(
		'before', 'after'
	);
	
	/*************************************************************************
	 *  PUBLIC INTERFACE
	 *************************************************************************/
	
	/**
	 * Looks up the derived class to find a matching pointcut definition
	 */
	public function findMatch( &$className, &$classMethodName ) {
	
		$this->process();
		
		$found = null;
		foreach( $cuts as $cut ) {
			if ($cut->isMatch( $className, $classMethodName )) {
				$found = $cut;
				break;
			}
		}//foreach

		return $found;
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
	
		$cuts = array();
	
		foreach( $cutDefinitionMethods as $method ) {
		
			$callback = array( $this, $method );
			if ( !is_callable( $callback ) )
				throw new Exception( __METHOD__.": can't access cut definition method ($method)" );
				
			$def = $this->$method();
			
			$this->validateCutDefinition( $def, $method /*exception*/ );
			
			$cut = aop::factory( 'aop_pointcut', $def['cp'], $def['mp'] );
			
			$cuts[] = $cut;
		}
		
		return $cuts;
	}
	/**
	 * Validates a cut definition
	 * 
	 * @param $method 
	 * @param $def
	 * @throws
	 * 
	 * TODO accumulate error list before throwing exception
	 */
	private function validateCutDefinition( &$def, &$method ) {

		// for starters, $def must be an array
		if ( !is_array( $def ))
			throw new Exception( __METHOD__.": cut definition method must return an array [method: $method]" );

		// check the required fields
		foreach( self::$requiredFields $field ) {
			if (!isset( $def[ $field ] ))
				throw new Exception( __METHOD__.": required field ($field) missing from pointcut definition [method: $method]");
		}
		
		// check that at least one of the optional fields is present
		$found = false;
		foreach( self::$optionalFields as $field ) {
			if ( isset( $def[ $field ] )) {
				$found = true;
				break;
			}
		}
		if ( !$found )
			throw new Exception( __METHOD__.": at least one optional field must be present in pointcut definition [method: $method]");
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
	extends aop_pointcut_definition {
	

	public function cut_id1() {
	
		return array(	'cp' 		=> 'classname-pattern1', 
						'mp' 		=> 'methodname-pattern1', 
						'before'	=> 'before_method', 
						'after'		=> 'after_method' );
	}
	
	
	public function cut_id2() {
	
		return array(	'cp' 		=> 'classname-pattern2', 
						'mp' 		=> 'methodname-pattern2', 
						'before'	=> 'before_method', 
						'after'		=> 'after_method' );
	}
	/**
	 * Advice definition 'before'
	 */
	public function before_method() {
		
	}
	/**
	 * Advice definition 'after'
	 */
	public function after_method() {
		
	}
	
	
}//
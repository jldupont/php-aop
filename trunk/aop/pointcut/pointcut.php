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

class aop_pointcut
	extends aop_object {

	/**
	 * Computed REGEX pattern for class field
	 * @access private
	 */
	var $classPattern = null;

	/**
	 * Computed REGEX pattern for method field
	 * @access private
	 */
	var $methodPattern = null;
	
	/**
	 * ClassName pattern
	 * @access private
	 */
	var $classNamePattern = null;
	
	/**
	 * MethodName pattern
	 * @access private
	 */
	var $methodNamePattern = null;

	/**
	 * Advice code stored as list
	 * @access private
	 */
	var $advicesCode = array();
	
	/**
	 * Advice:Method mapping
	 */
	var $adviceMethods = array();
	
	/*************************************************************************
	 *  PUBLIC INTERFACE
	 *************************************************************************/
	public function __construct( &$definition ) {
	
		$this->classNamePattern = $definition['cp'];
		$this->methodNamePattern = $definition['mp'];
		$this->adviceMethods = $definition['am'];
		
		// pre-compute the match patterns
		$this->classPattern = $this->computePattern( $this->classNamePattern );
		$this->methodPattern = $this->computePattern( $this->methodNamePattern );		
	}
	/**
	 * Returns the method name associated with an advice type
	 * 
	 * @param $type string advice type
	 */
	public function getMethodNameForAdviceType( $type ) {
	
		if (!isset( $this->adviceMethods[ $type ] ))
			return null;
			#throw new aop_exception( ": advice type ($type) not set " );
			
		return $this->adviceMethods[ $type ];
	}
	/**
	 * Sets the advice code related to an advice type
	 * 
	 * @param $type string advice-type
	 * @param $codeTokenList array of tokens
	 * @return void
	 */
	public function setAdviceCode( $type, $codeTokenList ) {
	
		$this->advicesCode[ $type ] = $codeTokenList;		
	}
	/**
	 * Gets the advice code related to an advice type
	 * 
	 * @param $type string advice-type
	 */
	public function getAdviceCode( $type ) {
		
		if ( !isset( $this->advicesCode[ $type ] ) )
			return null;
			#throw new aop_exception( __METHOD__.": advice code not set for type ($type)" );
			
		return $this->advicesCode[ $type ];
	}
	/**
	 * Looks up the derived class to find a matching pointcut definition
	 * @param string $className
	 * @param string $classMethodName OR ~
	 * @return boolean
	 */
	public function isMatch( &$className, $classMethodName ) {
		
		$result_class  = preg_match( $this->classPattern, $className ) === 1;
		
		// handle 'wildcard'
		if ( $classMethodName == '~' )
			$result_method = true;
		else
			$result_method = preg_match( $this->methodPattern, $classMethodName ) === 1;

		return ( $result_class and $result_method );
	}
	
	/*************************************************************************
	 *  PROTECTED INTERFACE
	 *************************************************************************/
	
	/**
	 * Computes a REGEX pattern
	 * 
	 * @param $pattern string simple pattern
	 * @return $regex_pattern string 
	 */
	protected function computePattern( $pattern ) {
	
		$p = preg_quote( $pattern );
		return '/^' . str_replace( '~', '(.*)', $p ) . '$/siU';
	}
	
}//end definition

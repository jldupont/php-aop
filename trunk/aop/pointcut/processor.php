<?php
/**
 * aop_pointcut_processor
 * PHP-AOP framework
 *
 * Extracts advice methods from a pointcut definition class
 *  
 * @author Jean-Lou Dupont
 * @package AOP
 * @category AOP
 * @pattern borg
 */

class aop_pointcut_processor
	extends aop_object {

	/**
	 * Beautifier_Extracter object instance
	 */
	var $bExtracter = null;
	
	/**
	 * Beautifier Filter Extracter object instance
	 */
	var $bFilterExtracter = null;
	
	/**
	 * Source class file text
	 */
	var $source = null;
	
	/**
	 * Method collector object instance
	 */
	var $collector = null;
	
	/**
	 * Constructor
	 * 
	 * @param $source string class text file
	 */
	public function __construct( &$source ) {
	 	$this->source = $source;
	}
	
	/**
	 * Processes (once) the source file
	 */
	public function process() {
	
		if ( !is_null( $this->collector ) )
			return $this->collector;

		$this->collector = aop::factory( 'aop_method_collector' );
			
		$this->bExtracter = aop::factory( 'aop_beautifier_extracter' );
		$this->bFilterExtracter = aop::factory( 'aop_filter_extracter', $this->bExtracter );
		
		$this->bExtracter->addFilter( $this->bFilterExtracter );

		$this->bExtracter->setInputString( $this->source );
		$this->bExtracter->process();

		// the extracted methods are stored in the Beautifier_Extracter instance
	}
	
}//end class
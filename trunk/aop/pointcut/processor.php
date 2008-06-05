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
	 * Pointcut definitions 
	 * @access private
	 */
	var $definition = null;
	
	/**
	 * Constructor
	 * 
	 * @param $source string class text file
	 */
	public function __construct( &$path ) {
	
		$this->path   = $path;
	}
	
	/**
	 * Processes (once) the source file
	 */
	public function process() {
	
		if ( !is_null( $this->collector ) )
			return $this->collector;

		$this->source = @file_get_contents( $this->path );
			
		// collect the class methods
		$this->collector = $this->extractClassMethods();
		
		// collect the pointcut definitions
		$this->definition = $this->extractDefinitions();
		
		// now we have the 2pieces to our puzzle:
		// 1- the pointcut definitions
		// 2- the advice method definitions
		// We need to join to 2 together in the aop_pointcut object
		return $this->joinPieces();
	}
	/**
	 * Joins the advice methods with the corresponding
	 * pointcut definition 
	 */
	private function joinPieces() {
	
		$cuts = $this->definition->getCuts();
		
		foreach( $cuts as $index => &$cut ) {
		
		}
		
		return $cuts;
	}
	/**
	 * Extracts the definition from the source file
	 * 
	 * @return aop_pointcut_definition object instance 
	 */
	private function extractDefinitions() {
	
		// by 'including' this file ...
		$result = include_once $this->path;
		
		if ( !$result ) {
			throw new aop_exception(": error whilst including path (".$this->path.")");
		}
		
		$classThatDefinesThePointcut = $this->inferDefinitionClassName();
		
		// and processing this file, the definitions
		// will get populated automatically.
		if ( empty( $classThatDefinesThePointcut ) )
			throw new aop_exception( ": pointcut definition file invalid: is there a 'return' statement indicating the classname?" );
		
		// TODO Use 'duckTyping' as interface
		//if (!( $classThatDefinesThePointcut implements findMatch ))
		//	throw new aop_exception( ": the pointcut definition file provided does not appear valid" );
		
		// instantiate one of these
		$def = new $classThatDefinesThePointcut;
		
		return $def->process();
	}
	/**
	 * Extracts all the class methods from the specified source
	 * 
	 * @return aop_token_collector
	 */
	private function extractClassMethods( ){
	
		$this->bExtracter = aop::factory( 'aop_beautifier_extracter' );
		
		// extracts all methods
		$this->bExtracter->setAll();
		
		$this->bFilterExtracter = aop::factory( 'aop_filter_extracter', $this->bExtracter );
		
		$this->bExtracter->addFilter( $this->bFilterExtracter );

		$this->bExtracter->setInputString( $this->source );
		$this->bExtracter->process();

		// the extracted methods are stored in the Beautifier_Extracter instance
		return $this->bExtracter->getExtractedList();
	
	}
	/**
	 * Infers the definition class name from the
	 * $path provided.
	 * 
	 * @return string
	 */
	private function inferDefinitionClassName(){
	
		$path_parts = pathinfo( $this->path );
		$filename = $path_parts['filename'];
		
		// really get just the first part of the filename
		$bits = explode( '.', $filename );
		
		return $bits[0]; 
	}
	
}//end class
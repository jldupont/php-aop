<?php
/**
 * aop_pointcut_processor
 * PHP-AOP framework
 *
 * Extracts advice methods from a pointcut definition class.
 * A pointcut definition class must end with '_pointcuts'.
 * @example 
 * 		class Whatever_pointcuts {
 * 		}
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
	var $collectorList = null;
	
	/**
	 * Pointcut definitions 
	 * @access private
	 */
	var $definition = null;
	
	var $classDefinitionName = null;
	
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
	
		if ( !is_null( $this->collectorList ) )
			return $this->collectorList;

		$this->classDefinitionName = $this->inferDefinitionClassName();
		if ( empty( $this->classDefinitionName ) )
			throw new aop_exception( ": pointcut definition filename invalid" );
			
		$this->source = @file_get_contents( $this->path );
			
		// collect the class methods
		$this->collectorList = $this->extractClassMethods();
		
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

			// let's grab a universal iterator to track the advice types
			$iterator = aop_factory::get( 'aop_iterator', $cut, 'adviceMethods' );	
		
			foreach( $iterator as $type => $methodName ) {
			
				$finder = aop_factory::get( 'aop_token_finder', $this->collectorList );
				$index = $finder->findMatch( $this->classDefinitionName, $methodName);
				if ( is_null( $index ))
					throw new aop_exception(": missing method definition for advice type($type)");

				$collector = $this->collectorList[ $index ];
				$cut->setAdviceCode( $type, $collector->getList() );
				
			}//foreach
			
		}//foreach
		
		return $cuts;
	}
	/**
	 * Extracts the definition from the source file
	 * 
	 * @return aop_pointcut_definition object instance 
	 */
	private function extractDefinitions() {
	
		// by 'including' this file ...
		// and processing this file, the definitions
		// will get populated automatically.
		$result = include_once $this->path;
		
		if ( !$result ) {
			throw new aop_exception(": error whilst including path (".$this->path.")");
		}

		$classe = $this->classDefinitionName;
				
		if (! class_exists( $classe ) )
			throw new aop_exception( ": the pointcut definition file provided does not appear valid" );
		
		// instantiate one of these
		$def = new $classe;
		
		return $def->process();
	}
	/**
	 * Extracts the token list associated with each of 
	 * the class methods from the specified source
	 * 
	 * @return aop_token_collector
	 */
	private function extractClassMethods( ){
	
		$this->bExtracter = aop_factory::get( 'aop_beautifier_extracter' );
		
		// extracts all methods
		$this->bExtracter->setAll();
		
		$this->bFilterExtracter = aop_factory::get( 'aop_filter_extracter', $this->bExtracter );
		
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
		
		return $bits[0] . '_pointcuts'; 
	}
	
}//end class
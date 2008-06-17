<?php
/**
 * aop_file_source
 * PHP-AOP framework
 * 
 * Handles PHP source files.
 * 
 * @author Jean-Lou Dupont
 * @package AOP
 * @category AOP
 * @pattern TemplateMethod
 */

class aop_file_source
	extends aop_file {

	/**
	 * Performs beautification on process()
	 */
	var $performBeautification = false;
		
	/**
	 * Beautified content
	 * @access public
	 */
	var $beautified_content = null;
	
	// =======================================================================
	//							PUBLIC INTERFACE
	// =======================================================================
	
	public function __construct( &$path, &$content = null ) {
	
		parent::__construct( $path, $content );
	}
	
	public function setBeautificationState( $state ) {
		assert( is_boolean( $state ) );
		$this->performBeautification = $state;
	}
	
	// =======================================================================
	//							TEMPLATE METHODS
	// =======================================================================
	
	/**
	 * Processes the file
	 * The user of this class should call the 'exists()' method
	 * before 'process()' the file.
	 * 
	 * @return boolean result
	 * @throws aop_file_exception
	 */
	public function _process( &$content = null ) {

		if ( !$this->performBeautification || empty( $content ) )
			return $content;
	
		$oBeaut = new PHP_Beautifier();
		
		$oBeaut->addFilter('NewLines');			
		$oBeaut->addFilter('IndentStyles');			
		$oBeaut->addFilter('ArrayNested');
	
		$oBeaut->setInputString( $content );
		$oBeaut->process();
		
		return $oBeaut->get();
	
	}

	/**
	 * Transform the source path to the desired path for the pointcut
	 * definition file
	 */
	protected function transformPath() {
		
		// do nothing
	}
	// =======================================================================
	//							SUB-CLASSED METHODS
	// =======================================================================

	/**
	 * isRecyclable
	 *  Related to object pool functionality
	 */
	public function isRecyclable() {
		return true;
	}
	
	public function init( &$path, &$content = null ) {
		
		$this->beautified_content = null;
		return parent::init( $path, $content );
	}
	
	/**
	 * Save - don't need to do anything special
	 * but not let the base class save to filesystem  
	 */
	public function write( &$content ) {

		$this->beautified_content = $content;
	
		// this can only fail for reasons beyond
		// our control here.
		return true;
	}
	/**
	 * Returns the beautified content
	 * i.e. not the original
	 */
	public function getContent() {
	
		return $this->beautified_content;
	}
	

}//end definition
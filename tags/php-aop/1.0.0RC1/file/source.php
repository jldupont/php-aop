<?php
/**
 * aop_file_source
 * PHP-AOP framework
 * 
 * source file
 * 
 * @author Jean-Lou Dupont
 * @package AOP
 * @category AOP
 * @pattern TemplateMethod
 */

class aop_file_source
	extends aop_file {

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

		if ( empty( $content ))
			return null;
	
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
	
	// =======================================================================
	//							PROTECTED METHODS
	// =======================================================================	
	
}//end definition
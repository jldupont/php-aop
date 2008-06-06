<?php
/**
 * aop_file_basephp
 * PHP-AOP framework
 * 
 * Generates a 'beautified' representation of a base PHP file.
 * This helps other processes such as the 'weaver' to insert
 * tokens at the proper place.
 * 
 * @author Jean-Lou Dupont
 * @package AOP
 * @category AOP
 */

class aop_file_basephp
	extends aop_file {

	const RepresentationFragment = 'beautified';
	
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
	 * Generates the beautified version of the source file
	 * 
	 * @throws aop_file_basephp
	 */	
	protected function generateRepresentation() {
	
		try {
		
			$content = $this->generateBeautified( );
			
		} catch( Exception $e ) {
		
			$this->raise( __CLASS__.'_exception', "can't beautify file (".$this->path.")" );
		}
		
		return $content;
	}
	/**
	 * 
	 */
	protected function getRepresentationPath() {
	
		return $this->generatePathForRepresentation( self::RepresentationFragment );
	}
	
	// =======================================================================
	//							PROTECTED METHODS
	// =======================================================================	
	
	/**
	 * Generates a 'beautified' version of the base file
	 * This step helps PHP_Parser and reduces the potential for errors
	 */
	protected function generateBeautified() {

		$oBeaut = new PHP_Beautifier();
		
		$oBeaut->addFilter('NewLines');			
		$oBeaut->addFilter('IndentStyles');			
		$oBeaut->addFilter('ArrayNested');
	
		$oBeaut->setInputString( $this->content );
		$oBeaut->process();
		
		return $oBeaut->get();
	}
		
}//end definition
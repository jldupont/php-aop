<?php
/**
 * aop_weaver class
 * PHP-AOP framework
 * 
 * @author Jean-Lou Dupont
 * @package AOP
 * @category AOP
 */

class aop_weaver 
	extends aop_object {

	/**
	 * Pointcut list
	 * @access public
	 */
	var $pointcuts = null;
	
	var $iFileObj = null;
	var $oFileObj = null;
	
	// =======================================================================
	//							PUBLIC INTERFACE
	// =======================================================================
	
	/**
	 * Constructor 
	 */
	public function __construct() {
	
		parent::__construct();
	}
	
	/**
	 * Sets the list of pointcuts 
	 */
	public function setPointcutList( &$pointcuts ) {
	
		$this->pointcuts = $pointcuts;
		return $this;
	}

	public function setInputFile( &$iFileObj ) {
	
		$this->iFileObj = $iFileObj;
		return $this;
	}
	public function setOutputFile( &$oFileObj ) {
	
		$this->oFileObj = $oFileObj;
		return $this;
	}
	
	/**
	 * Performs 'weaving' on the specified file
	 * with pointcuts found in the specified list
	 * 
	 * @return $result boolean
	 * @throws aop_weaver_exception
	 */
	public function weave( ) {
	
		$bweaver = aop::factory( 'aop_beautifier_inserter' );
		$ifilter = aop::factory( 'aop_filter_inserter', $bweaver );
	
		$bweaver->setPointcutList( $this->pointcuts );
		
		$bweaver->addFilter( $ifilter );
		$bweaver->setInputString( $this->iFileObj->getContent() );
		
		$bweaver->process();
		
		$result = $bweaver->get();
		
		$this->oFileObj->setContent( $result );
		
		// effectively just saves the result in the file
		$this->oFileObj->process();
	}

}//end definition
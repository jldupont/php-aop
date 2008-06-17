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
	
	/**
	 * Input aop_file
	 */
	var $iFileObj = null;
	
	/**
	 * Output aop_file 
	 */
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
	 * @see aop_factory
	 */
	public function init() {
		$this->pointcuts = null;
		$this->iFileObj  = null;
		$this->oFileObj  = null;		
	}
	/**
	 * @see aop_factory
	 */
	public function isRecyclable() {
		return true;
	}
	
	/**
	 * Sets the list of pointcuts 
	 */
	public function setPointcutList( &$pointcuts ) {
	
		$this->pointcuts = $pointcuts;
		return $this;
	}
	/**
	 * Sets the input aop_file instance
	 */
	public function setInputFile( &$iFileObj ) {
	
		$this->iFileObj = $iFileObj;
		return $this;
	}
	/**
	 * Sets the output aop_file instance
	 */
	public function setOutputFile( &$oFileObj ) {
	
		$this->oFileObj = $oFileObj;
		return $this;
	}
	
	/**
	 * Performs 'weaving' on the specified file
	 * with pointcuts found in the specified list
	 * 
	 * @return $result boolean
	 * @throws 
	 */
	public function weave( ) {
	
		$bweaver = aop_factory::get( 'aop_beautifier_inserter' );
		$ifilter = aop_factory::get( 'aop_filter_inserter', $bweaver );
	
		// for aop_filter_inserter
		$bweaver->setPointcutList( $this->pointcuts );
		
		$bweaver->addFilter( $ifilter );
		$bweaver->setInputString( $this->iFileObj->getContent() );
		
		try {
			$bweaver->process();
		} catch(Exception $e) {
			throw new aop_exception( $e->getMessage() );
		}
		$result = $bweaver->get();
		
		// recycle!
		aop_object_pool::recycle( $bweaver );
		aop_object_pool::recycle( $ifilter );
		
		$this->oFileObj->setContent( $result );
		
		// effectively just saves the result in the file
		return $this->oFileObj->process();
	}

}//end definition
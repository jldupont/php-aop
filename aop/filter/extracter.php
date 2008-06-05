<?php
/**
 * aop_filter_extracter
 * PHP-AOP framework
 * 
 * @author Jean-Lou Dupont
 * @package AOP
 * @category AOP
 * @pattern Template Method
 */

class aop_filter_extracter 
	extends aop_filter_class {

	/**
	 * Token Collector Object
	 * @access private
	 */
	var $collector = null;
	
	/**
	 * Constructor
	 */
    public function __construct(PHP_Beautifier $oBeaut, $aSettings = array()) {
    
        parent::__construct($oBeaut, $aSettings);
    }
    /**
     * Start of method
     * 
     * @param $sTag current filter tag - not used
     * @param $classe class-name
     * @param $name method-name
     * @return void
     */
	public function t_start_method( &$sTag, &$classe, &$name ) {

		$this->collector = $this->oBeaut->getMatching( $classe, $name );
	}
    /**
     * End of method
     * 
     * @param $sTag current filter tag - not used
     * @param $classe class-name
     * @param $name method-name
     * @return void
     */
	public function t_end_method( &$sTag, &$classe, &$name ) {

		$this->commit( );
	}

	/**
	 * @see PHP_Beautifier_Filter::handleToken
	 */
	public function handleToken( $token ) {
	
		if ( !is_null( $this->collector ))
			$this->collector->push( $token );
			
		return parent::handleToken( $token );
	}
	
	/**
	 * Commits an extraction
	 */
	private function commit() {
	
		$this->oBeaut->commit( $this->collector );
		$this->collector = null;
		
	}
	
}//end class

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

    public function __construct(PHP_Beautifier $oBeaut, $aSettings = array()) 
    {
        parent::__construct($oBeaut, $aSettings);
    }
    
	public function t_start_class( &$sTag, &$name ) {
	
		$this->oBeaut->add('//INSERTED @ start_class');
		$this->oBeaut->addNewLineIndent();
	}

	public function t_start_method( &$sTag, &$name ) {

		$this->oBeaut->add('//INSERTED @ start_method');
		$this->oBeaut->addNewLineIndent();
	}

	public function t_end_class( &$sTag, &$name ) {
	
		$this->oBeaut->add('//INSERTED @ end_class');
		$this->oBeaut->addNewLineIndent();
	}

	public function t_end_method( &$sTag, &$name ) {

		$this->oBeaut->add('//INSERTED @ end_method');
		$this->oBeaut->addNewLineIndent();
	}
        
}//end class

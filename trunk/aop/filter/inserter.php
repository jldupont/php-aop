<?php
/**
 * aop_filter_inserter
 * PHP-AOP framework
 * 
 * This class extends PHP/Beautifier with "insertion" capabilities:
 * - add arbitrary code at the START of a method
 * - add arbitrary code at the END of a method
 * This functionality satisfies the requirement to have:
 * - "before" style pointcuts
 * - "after" style pointcuts
 * - "around" style pointcuts  => "before" + original code + "after"
 * 
 * @author Jean-Lou Dupont
 * @package AOP
 * @category AOP
 * @pattern Template Method
 */

class aop_filter_inserter 
	extends aop_filter_class {
	
    public function __construct(PHP_Beautifier $oBeaut, $aSettings = array()) 
    {
        parent::__construct($oBeaut, $aSettings);
    }
    
	public function t_start_method( &$sTag, &$classe, &$name ) {

		$tokensToInsert = $this->oBeaut->findMatch( $classe, $name, 'before' );
		if ( !empty( $tokensToInsert ) ) {

			$this->oBeaut->add( $tokensToInsert );
			$this->oBeaut->addNewLineIndent();
		}
	}

	public function t_end_method( &$sTag, &$classe, &$name ) {

		$tokensToInsert = $this->oBeaut->findMatch( $classe, $name, 'after' );
		if ( !empty( $tokensToInsert ) ) {

			$this->oBeaut->add( $tokensToInsert );
			$this->oBeaut->addNewLineIndent();
		}
	}
            
}//end class

<?php
/**
 * PHP_Beautifier_Filter_Inserter_Template
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

class PHP_Beautifier_Filter_Inserter_Template extends PHP_Beautifier_Filter
{
	var $oBeaut = null;
	
	var $machine = null;

    protected $aFilterTokenFunctions = array(
    
        T_CLASS => 't_class',
        'T_OPEN_OPEN_BRACE' => 't_open_brace'
        
    );
    public function __construct(PHP_Beautifier $oBeaut, $aSettings = array()) 
    {
    	$this->oBeaut = $oBeaut;
    	
    	$this->machine = new aop_weaver_filter_Inserter_Machine;
    	
        parent::__construct($oBeaut, $aSettings);
    }
    /**
     * Processes an 'event' through the state-machine
     */
    protected function processEvent( $event, &$sTag ) {
    
    }

	// ======================================================================
	// EVENTS
	// ======================================================================
    
	/**
	 * Processes a T_CLASS event
	 */    
	function t_class($sTag) {

    }
	/**
	 * T_OPEN_BRACE event
	 */
	function t_open_brace($sTag) {
	
    	return PHP_Beautifier_Filter::BYPASS;    
	}

	
	// ======================================================================
	// DEFAULTS
	// ======================================================================

	
   	/** 
   	 * Default 'open_brace' filter method
   	 * @see PHP_Beautifier/Filter/Default.filter.php
   	 */ 
    function default_t_open_brace( &$sTag ){
    
        if ($this->oBeaut->isPreviousTokenConstant(T_VARIABLE) or $this->oBeaut->isPreviousTokenConstant(T_OBJECT_OPERATOR) or ($this->oBeaut->isPreviousTokenConstant(T_STRING) and $this->oBeaut->getPreviousTokenConstant(2) == T_OBJECT_OPERATOR) or $this->oBeaut->getMode('double_quote')) {
            $this->add($sTag);
        } else {
            if ($this->oBeaut->removeWhiteSpace()) {
                $this->oBeaut->add(' ' . $sTag);
            } else {
                $this->oBeaut->add($sTag);
            }
            $this->oBeaut->incIndent();
            if ($this->oBeaut->getControlSeq() == T_SWITCH) {
                $this->oBeaut->incIndent();
            }
            $this->oBeaut->addNewLineIndent();
        }
    
    }
    
}

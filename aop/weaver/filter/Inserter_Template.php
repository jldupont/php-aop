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

class PHP_Beautifier_Filter_Inserter_Template 
	extends PHP_Beautifier_Filter {
	/**
	 * PHP_Beautifier context
	 */
	var $oBeaut = null;
	
	/** 
	 * The state-machine
	 */
	var $machine = null;

	/**
	 * The current class passing through the filter
	 */
	var $currentClass = null;
	
	/**
	 * Depth level for the current class
	 */
	var $depthLevelForClass = 0;
	
	/**
	 * The current class method passing through the filter
	 */
	var $currentMethod = null;
	
	/**
	 * Depth level for the current method
	 */
	var $depthLevelForMethod = null;
	
	/**
	 * The current depth in brace level
	 */
	var $currentDepth = 0;
	
	/**
	 * Tokens that this filter processes
	 */
    protected $aFilterTokenFunctions = array(
    
        T_CLASS 			=> 't_class',
        T_FUNCTION 			=> 't_function',
        'T_OPEN_BRACE' 		=> 't_open_brace',
        'T_CLOSE_BRACE'		=> 't_close_brace',
        
    );
    
    /**
     * Constructor
     */
    public function __construct(PHP_Beautifier $oBeaut, $aSettings = array()) 
    {
    	$this->oBeaut = $oBeaut;
    	
    	$this->machine = new aop_weaver_filter_Inserter_Machine;
    	
        parent::__construct($oBeaut, $aSettings);
    }

	// ======================================================================
	// EVENTS
	// ======================================================================
    
	/**
	 * Processes a T_CLASS event
	 */    
	function t_class($sTag) {

		$this->depthLevelForClass = $this->currentDepth;	
		$this->currentClass = $this->oBeaut->getNextTokenContent();
		return $this->dispatch( 't_class', $sTag );
		
    }
	/**
	 * T_OPEN_BRACE event
	 */
	function t_open_brace($sTag) {
	
		$this->currentDepth++;
		return $this->dispatch( 't_open_brace', $sTag );
		    
	}
	/**
	 * T_CLOSE_BRACE event
	 */
	function t_close_brace($sTag) {

		$this->currentDepth--;	
	
		$leavingMethod = false;
		
		// make sure to update currentMethod state upon leaving
		// the method's definition scope
		if ( $this->currentDepth === $this->depthLevelForMethod ) {
			
			$this->currentMethod = null;
			$leavingMethod = true;
		}

		$leavingClass  = false;
		
		// make sure to update currentMethod state upon leaving
		// the class's definition scope
		if ( $this->currentDepth === $this->depthLevelForClass ) {
			
			$this->currentClass = null;
			$leavingClass = true;
		}
		
		if ( $leavingMethod )
			return $this->dispatch( 't_end_method', $sTag );

		if ( $leavingClass )
			return $this->dispatch( 't_end_class', $sTag );

		return $this->dispatch( 't_close_brace', $sTag );				    
	}
	
	/**
	 * T_FUNCTION event
	 */
	function t_function($sTag) {
	
		$this->depthLevelForMethod = $this->currentDepth;
		$this->currentMethod = $this->oBeaut->getNextTokenContent();	
		return $this->dispatch( 't_function', $sTag );
		
    }
    
	// ======================================================================
	// HELPERS
	// ======================================================================
	
	/**
	 * Processes 'events' through the state-machine
	 */
	protected function dispatch( $event, $sTag ) {

		$signal = $this->machine->getSignal( $event );
		if ( $signal === false )
			return PHP_Beautifier_Filter::BYPASS;
	
		$name = 'signal_'.$this->machine->getCanonicalName( $signal );
		$handler = array( $this, $name );
		
		if (!is_callable( $handler ))
			throw new Exception( "handler related to event($event) can not dispatch signal($signal) to method ($name)" );
			
		return call_user_func( $handler, $sTag );
	}
	
	/**
	 * DEFAULTS
	 * @see Default.filter.php
	 *********************************************************************************/
	
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

    function default_t_close_brace($sTag) 
    {
        if ($this->oBeaut->getMode('string_index') or $this->oBeaut->getMode('double_quote')) {
            $this->oBeaut->add($sTag);
        } else {
            $this->oBeaut->removeWhitespace();
            $this->oBeaut->decIndent();
            if ($this->oBeaut->getControlSeq() == T_SWITCH) {
                $this->oBeaut->decIndent();
            }
            $this->oBeaut->addNewLineIndent();
            $this->oBeaut->add($sTag);
            $this->oBeaut->addNewLineIndent();
        }
    }
    
}//end

<?php
/**
 * PHP_Beautifier filter - class processor template-method class
 * PHP-AOP framework
 * 
 * @author Jean-Lou Dupont
 * @package AOP
 * @category AOP
 * @pattern Template Method
 */

class aop_filter_class 
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
	 * 
	 */
	var $nextOpenBrace = null;
	
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
		
		$this->nextOpenBrace = array( 'class', $this->currentClass );
		return PHP_Beautifier_Filter::BYPASS;
		
    }
	/**
	 * T_OPEN_BRACE event
	 */
	function t_open_brace($sTag) {
	
		$this->currentDepth++;
		
		if (is_null( $this->nextOpenBrace ))
			return PHP_Beautifier_Filter::BYPASS;

		$classe= $this->currentClass;
		$type = $this->nextOpenBrace[0];
		$name = $this->nextOpenBrace[1];
		
		$this->nextOpenBrace == null;
		
		switch( $type ) {
		case 'class':
			return $this->i_start_class( &$sTag, $name );
		case 'method':
			return $this->i_start_method( &$sTag, $classe, $name );		
		default:
			throw new Exception( __METHOD__.": invalid type ($type)" );
		}//switch
		
		// never end-up here
		return PHP_Beautifier_Filter::BYPASS;		
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
			return $this->i_end_method( $sTag, $this->currentMethod );

		if ( $leavingClass )
			return $this->i_end_class( $sTag, $this->currentClass );

		return $this->default_t_close_brace( $sTag );				    
	}
	
	/**
	 * T_FUNCTION event
	 */
	function t_function($sTag) {
	
		// if we are inside a class definition,
		// then we are really dealing with a method
		if ( !is_null( $this->currentClass )) {
		
			$this->currentMethod = $this->oBeaut->getNextTokenContent();
			$this->depthLevelForMethod = $this->currentDepth;
			$this->nextOpenBrace = array( 'method', $this->currentMethod );
		}

		return PHP_Beautifier_Filter::BYPASS; 
		
    }
	// ======================================================================
	// INTERNALS
	// ======================================================================
    public function i_start_class( &$sTag, &$className ) {
    
        $this->default_t_open_brace( $sTag );
		return $this->t_start_class( $sTag, $className );    
    }
    public function i_start_method( &$sTag, &$className, &$methodName ) {
    
        $this->default_t_open_brace( $sTag );
		return $this->t_start_method( $sTag, $className, $methodName );    
    }

    public function i_end_class( &$sTag, &$className ) {
    
		$this->t_end_class( $sTag, $className );    
        return $this->default_t_close_brace( $sTag );	    
    }
    public function i_end_method( &$sTag, &$methodName ) {
    
		$this->t_end_method( $sTag, $methodName );
		return $this->default_t_close_brace( $sTag );
    }
    
	// ======================================================================
	// DEFAULTS -- derived classes can redefine these
	// ======================================================================

	/**
	 * Start-of-Class event 
	 */
    public function t_start_class( &$sTag, &$className ) {
        
		return false;    
    }
    
	/**
	 * End-of-Class event 
	 */
    public function t_end_class( &$sTag, &$className ) {
    
		return false;
    }
    
	/**
	 * Start-of-Method event 
	 */
    public function t_start_method( &$sTag, &$className, &$methodName ) {
    
		return false;
    }

	/**
	 * End-of-Method event 
	 */
    public function t_end_method( &$sTag, &$methodName ) {
    
		return false;
    }
    
    
	/**
	 * DEFAULTS from PHP_Beautifier
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

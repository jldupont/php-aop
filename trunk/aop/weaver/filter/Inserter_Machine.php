<?php
/**
 * aop_weaver_filter_Inserter_Machine
 * PHP-AOP framework
 *
 * State Machine class for Inserter.filter.php 
 * 
 * @author Jean-Lou Dupont
 * @package AOP
 * @category AOP
 * @pattern Template Method
 * 
 * TODO implement a more complete state-machine in order to catch exceptions
 */
/*
 *    CURRENT STATE         EVENT             NEXT STATE             ACTION
 *    =============         =======           ==========             ======
 *    WAIT_CLASS            t_class           WAIT_FUNCTION
 * 
 *    WAIT_FUNCTION         t_function        WAIT_OPEN_BRACE
 *                          t_end_declare     WAIT_CLASS             
 * 
 *    WAIT_OPEN_BRACE       t_open_brace      WAIT_END_DECLARE       signal CLASS_START_METHOD
 * 
 *    WAIT_END_DECLARE      t_end_declare     WAIT_FUNCTION          signal CLASS_END_METHOD
 * 
 */

class aop_weaver_filter_Inserter_Machine 
	extends aop_object
{
	/**
	 * State Map
	 * @access private
	 */
	static $state_map = array(
	
		self::WAIT_CLASS      => array( 't_class'       => array( 'ns' => self::WAIT_FUNCTION,   's' => self::NO_SIGNAL ), 
							     ),
		self::WAIT_FUNCTION   => array( 't_function'    => array( 'ns' => self::WAIT_OPEN_BRACE, 's' => self::NO_SIGNAL  ),
									    't_end_declare' => array( 'ns' => self::WAIT_CLASS,      's' => self::NO_SIGNAL ),
							     ),
		self::WAIT_OPEN_BRACE => array( 't_open_brace'  => array( 'ns' => self::WAIT_END_DECLARE,'s' => self::SIGNAL_CLASS_METHOD_START ),
									    't_end_declare' => array( 'ns' => self::WAIT_CLASS,      's' => self::NO_SIGNAL ),
							     ),
		self::WAIT_END_DECLARE=> array( 't_end_declare' => array( 'ns' => self::WAIT_FUNCTION,   's' => self::SIGNAL_CLASS_METHOD_END ),
							     ),
	);
	/**
	 * List of allowed states
	 */
	static $allowedState = array(
		self::WAIT_CLASS,
		self::WAIT_FUNCTION,
		self::WAIT_OPEN_BRACE,
		self::WAIT_END_DECLARE
	);
	/**
	 * STATE CONSTANTS
	 * @access public 
	 */
	const WAIT_CLASS       = 1;
	const WAIT_FUNCTION    = 2;
	const WAIT_OPEN_BRACE  = 3;
	const WAIT_END_DECLARE = 4;
	
	/**
	 * Signal constants
	 */
	const NO_SIGNAL                 = 0;
	const SIGNAL_CLASS_METHOD_START = 1;
	const SIGNAL_CLASS_METHOD_END   = 2;
		
	/**
	 * Constructor
	 */
    public function __construct() 
    {        
        $this->state = self::WAIT_CLASS;
    
    	parent::__construct( );
    }
	/**
	 * Computes a 'signal' from a given event
	 * taking into account the current state
	 * 
	 * @param $event constant
	 */    
   	public function getSignal( $event ) {
   	
   		// retrieve list of events we can take action upon
   		$actionableEventList = self::$state_map[ $this->state ];
   		
   		if ( !in_array_keys( $event, $actionableEventList ) )
   			return self::NO_SIGNAL;

   		// we have a designated course of action:
   		$info   = $actionableEventList[ $event ];
   		$signal = $info[ 's'  ];
   		$next   = $info[ 'ns' ];
   		
   		// set 'next' state
   		$this->state = $next;
   		
   		return $signal;
   	}
   	
}//end declaration

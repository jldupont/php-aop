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

class aop_weaver_filter_Inserter_Machine {

	/**
	 * State Map
	 * @access private
	 */
	static $state_map = array(
	
		// CLASS start
		self::WAIT_CLASS      => array( 't_class'       => array( 'ns' => self::WAIT_FUNCTION,   's' => self::NO_SIGNAL ), 
							     ),

		// CLASS METHOD start							     
		self::WAIT_FUNCTION   => array( 't_function'    => array( 'ns' => self::WAIT_OPEN_BRACE, 's' => self::NO_SIGNAL  ),
										't_end_class'	=> array( 'ns' => self::WAIT_CLASS,      's' => self::NO_SIGNAL  ),
							     ),
							     
		// CLASS METHOD definition start	     
		self::WAIT_OPEN_BRACE => array( 't_open_brace'  => array( 'ns' => self::WAIT_END_METHOD, 's' => self::SIGNAL_CLASS_METHOD_START ),
							     ),
							     
		self::WAIT_END_METHOD => array( 't_end_method'  => array( 'ns' => self::WAIT_FUNCTION,   's' => self::SIGNAL_CLASS_METHOD_END ),
							     ),
	);
	/**
	 * List of allowed states
	 */
	static $allowedState = array(
		self::WAIT_CLASS,
		self::WAIT_FUNCTION,
		self::WAIT_OPEN_BRACE,
		self::WAIT_END_METHOD
	);
	/**
	 * STATE CONSTANTS
	 * @access public 
	 */
	const WAIT_CLASS       = 1;
	const WAIT_FUNCTION    = 2;
	const WAIT_OPEN_BRACE  = 3;
	const WAIT_END_METHOD  = 4;
	
	/**
	 * Signal constants
	 */
	const NO_SIGNAL                 = false;
	const SIGNAL_CLASS_METHOD_START = 1;
	const SIGNAL_CLASS_METHOD_END   = 2;

	/** 
	 * Signal Mapping table
	 * from integer to string canonical
	 */
	static $map = array(
		self::NO_SIGNAL 				=> 'no_signal',
		self::SIGNAL_CLASS_METHOD_START	=> 'class_method_start',
		self::SIGNAL_CLASS_METHOD_END	=> 'class_method_end',		
	);
	
	/**
	 * Constructor
	 */
    public function __construct() {        
        $this->state = self::WAIT_CLASS;
    }
	/**
	 * Computes a 'signal' from a given event
	 * taking into account the current state
	 * 
	 * @param $event constant
	 */    
   	public function getSignal( $event ) {
   	
   		$event = strtolower( $event );
   	
   		// retrieve list of events we can take action upon
   		$actionableEventList = self::$state_map[ $this->state ];
   		
   		if ( !array_key_exists( $event, $actionableEventList ) )
   			return self::NO_SIGNAL;

   		// we have a designated course of action:
   		$info   = $actionableEventList[ $event ];
   		$signal = $info[ 's'  ];
   		$next   = $info[ 'ns' ];
   		
   		// set 'next' state
   		$this->state = $next;
   		
   		return $signal;
   	}
   	/**
   	 * Translates a canonical signal integer
   	 * to a canonical signal name
   	 * 
   	 * @param $signal constant
   	 * @return $signal string
   	 * @throws
   	 */
   	public function getCanonicalName( &$signal ) {
   	
   		if ( !array_key_exists( $signal, self::$map ))
   			throw ErrorException( "no such signal index ($signal)" );
   			
   		return self::$map[ $signal ];
   	}
   	
}//end declaration
<?php
/**
 * aop_factory
 * PHP-AOP framework
 * 
 * @author Jean-Lou Dupont
 * @package AOP
 * @category AOP
 * @pattern borg
 * @pattern factory
 */

class aop_factory {
	
	/**
	 * Class map for the factory
	 * @access private
	 */
	private static $classMap = array();
		
	public function __construct() {	
	}

	/**
	 * Maps a class to another one
	 * Used along with the factory interface.
	 * 
	 * @param $oClasse string original class
	 * @param $rClasse string replacement class
	 * @return void
	 */
	public static function mapClass( $oClasse, $rClasse ) {
	
		self::$classMap[ $oClasse ] = $rClasse;
	}

	/**
	 * factory
	 * 
	 * @param $className name of class to instantiate/get (singleton)
	 * @param mixed optional parameters
	 * @return $object
	 */
	public static function get( $className /*optional params*/ ) {
	
		$args = func_get_args();
		array_shift( $args );	#$classname
	
		// check our replacement map
		if ( isset( self::$classMap[$className] )) {
		
			$classe = self::$classMap[$className];
			if ( !class_exists( $classe, true ))
				throw new aop_exception( "unable to load class ($className) remapped to ($classe)" );
			
			aop_logger::log( __METHOD__." REMAPPING: $className to $classe \n" );				
				
			return self::buildObject( $classe, $args );
		}
	
		// check the object pool
		$obj = aop_object_pool::get( $className );
		if ( !is_null( $obj )) {
			
			if ( is_callable( array( $obj, 'init' ) ))
				self::initObject( $obj, $args );
				
			aop_logger::log( __METHOD__." PROVIDING recycled class($className)" );
				
			return $obj;
		}
		
		// default i.e. no remapping
		if ( !class_exists( $className, true ))
			throw new aop_exception( "unable to load class $className" );
			
		return self::buildObject( $className, $args );
	}

	/**
	 * Builds an object instance of the specified class
	 * and passes properly a variable argument list
	 * 
	 * @param $classe
	 * @param $args mixed
	 * @return $object
	 * @throws aop_exception when too many arguments are passed in array $args
	 */
	private static function buildObject( &$classe, Array &$args ) {
	
		aop_logger::log( __METHOD__." BUILDING an object of class($classe)" );
		
		$count = count( $args );
		
		switch( $count ) {
		case 0:
			return new $classe;
		case 1:
			return new $classe( $args[0] );
		case 2:
			return new $classe( $args[0], $args[1] );
		case 3:
			return new $classe( $args[0], $args[1], $args[2] );
		case 4:
			return new $classe( $args[0], $args[1], $args[2], $args[3] );
		default:
			throw new aop_exception( "unsupported number of arguments whilst creating object in factory" );
		}
	}
	
	private function initObject( &$obj, &$args ) {

		$classe = get_class( $obj );
		aop_logger::log( __METHOD__." INITIALIZING an object of class($classe)" );
				
		$count = count( $args );
		
		switch( $count ) {
		case 0:
			return $obj->init( );
		case 1:
			return $obj->init( $args[0] );
		case 2:
			return $obj->init( $args[0], $args[1] );
		case 3:
			return $obj->init( $args[0], $args[1], $args[2] );
		case 4:
			return $obj->init( $args[0], $args[1], $args[2], $args[3] );
		default:
			throw new aop_exception( "unsupported number of arguments whilst initializing object in factory" );
		}
	}
	

}//end class
<?php
/**
 * aop_object_pool
 * PHP-AOP framework
 * 
 * @author Jean-Lou Dupont
 * @package AOP
 * @category AOP
 * @pattern borg
 */

class aop_object_pool {

	/**
	 * Object Pool
	 */
	static $objList = array();
	
	/**
	 * Constructor
	 */
	public function __construct() {
	}
	
	/**
	 * Returns an object from $class from the pool
	 * 
	 * @param $class string class name
	 * @return mixed
	 */
	public static function get( $class ) {

		if (!isset( self::$objList[ $class ] ))
			return null;

		aop_logger::log( __METHOD__." RETRIEVING an object from class($class) from the recycle bin" );
		
		$obj = array_shift( self::$objList[$class] );
		
		return $obj;
	}

	/**
	 * Places an object in the recycle pool
	 * 
	 * @param $obj object
	 */
	public static function recycle( &$obj ) {
		
		$class = get_class( $obj );
				
		// is this recyclable at all?
		$recyclable = false;
		$callback = array( $obj, 'isRecyclable' );
		if ( is_callable( $callback ) ) {
			$recyclable = $obj->isRecyclable();
		}
		if ( !$recyclable ) {
			aop_logger::log( __METHOD__." CAN'T recycle object of class($class)" );
			unset( $obj );
			return; 
		}
		
		aop_logger::log( __METHOD__." ADDING an object from class($class) to the recycle bin" );		
		
		self::$objList[$class][] = $obj;
	}
	
}//end definition
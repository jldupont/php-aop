<?php
/**
 * aop_object_pool
 * PHP-AOP framework
 * 
 * @author Jean-Lou Dupont
 * @package AOP
 * @category AOP
 * @pattern borg
 * @pattern ObjectPool
 *
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

		// is there one?
		if (!isset( self::$objList[ $class ] ))
			return null;

		aop_logger::log( __METHOD__." RETRIEVING an object from class($class) from the recycle bin" );
		
		// retrieve from list
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
		// Use 'duck typing' to inquire about the object's recycling attribute:
		// this additional check makes it more user friendly i.e. any object
		// can be sent to the recycle bin without causing problems. 
		$recyclable = false;
		$callback = array( $obj, 'isRecyclable' );
		if ( is_callable( $callback ) )
			$recyclable = $obj->isRecyclable();

		if ( !$recyclable ) {
			aop_logger::log( __METHOD__." CAN'T recycle object of class($class)" );
			unset( $obj );
			return; 
		}
		
		aop_logger::log( __METHOD__." ADDING an object from class($class) to the recycle bin" );		
		
		self::$objList[$class][] = $obj;
	}
	
}//end definition
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

		aop_logger::log( __METHOD__." retrieving an object from class: $class" );
		
		if (!isset( self::$objList[ $class ] ))
			return null;
			
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

		aop_logger::log( __METHOD__." recycling an object from class: $class" );		
		
		self::$objList[$class][] = $obj;
	}
	
}//end definition
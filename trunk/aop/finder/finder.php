<?php
/**
 * finder class
 *  This class is used to 'find' class implementation through
 *  the registered class paths.
 * 
 * PHP-AOP framework
 * 
 * @author Jean-Lou Dupont
 * @package AOP
 * @category AOP
 */

class aop_finder 
	implements aop_singleton {

	static $instance = null;
	
	protected function __construct() {
	
	}
	
	public static function singleton() {
	
		if (!is_null( self::$instance ))
			return self::$instance;
	
		$classe = __CLASS__;
		return (self::$instance = new $classe);
	}

}//end definition
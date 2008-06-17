<?php
/**
 * aop_logger
 * PHP-AOP framework
 * 
 * 
 * @author Jean-Lou Dupont
 * @package AOP
 * @category AOP
 */

class aop_logger {
	
	static $logger = null;
	
	public static function set( &$logger ) {
		self::$logger = $logger;
	}
	
	public static function log( $message, $priority = null ) {
		
		if ( is_null( self::$logger ))
			return;
		self::$logger->log( $message, $priority );
	}
	
}
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
	
	static $debug = false;
	
	public static function set( &$logger, $debug = false ) {
		self::$logger = $logger;
		self::$debug  = $debug;
	}
	
	public static function log( $message, $priority = null ) {
		
		if ( is_null( self::$logger ))
			return;
			
		if ( self::$debug ) {
			$peak = memory_get_peak_usage();
			$message = "PEAK[$peak] ".$message;
		}
			
		self::$logger->log( $message, $priority );
	}
	
}
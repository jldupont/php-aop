<?php
/**
 * aop_file_comparator
 * PHP-AOP framework
 * 
 * Utility class to compare aop_file objec instances.
 * 
 * @author Jean-Lou Dupont
 * @package AOP
 * @category AOP
 */

class aop_file_comparator
	extends aop_object {
	
	const TIMESTAMP_EQUAL = 0;
	const TIMESTAMP_NEWER = 1;
	const TIMESTAMP_OLDER = 2;
	
	/**
	 * Compares the mtime of two aop_file objects
	 * 
	 * @return TIMESTAMP_xyz code
	 */
	public static function compare_mtime( &$f1, &$f2 ) {

		try {
		
			$t1 = $f1->get_mtime();
			$t2 = $f2->get_mtime();
			
		} catch( Exception $e ) {
		
			throw new aop_exception( __METHOD__.": aop_file object expected" );	
		}
	
		if ( $t1 === false or $t2 === false )
			throw new aop_exception( __METHOD__.": aop_file does not exist" );
			
		if ( $t1 == $t2 )
		 	return self::TIMESTAMP_EQUAL;
	
		 return ( $t1 > $t2 ) ? self::TIMESTAMP_NEWER : self::TIMESTAMP_OLDER ;
	}
	
}//endclass
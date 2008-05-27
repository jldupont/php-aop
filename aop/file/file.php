<?php
/**
 * aop_file
 * PHP-AOP framework
 * 
 * - create from class file
 * 
 * @author Jean-Lou Dupont
 * @package AOP
 * @category AOP
 */

class aop_file
	extends aop_list {
	
	var $path = null;
	var $content = null;
	
	public function __construct( &$path, &$contents ) {
	}
	
	public static function newFromFile( &$path ) {
	
		$content = file_get_contents( $path );
		if ( $content === false )
			throw new aop_file_exception( "error reading file from $path" );
		
		return new aop_file( $path, $content );
	}
	
	public function tokenize() {
		
	}
	
	/**
	 * Inserts a list of token at the specified
	 * index in the original tokenized list 
	 */
	public function insertTokenList( $index, &$liste ) {
	
	}
	
}//end definition
<?php
/**
 * aop_listborg
 * PHP-AOP framework
 * 
 * @author Jean-Lou Dupont
 * @package AOP
 * @category AOP
 * @pattern borg
 */

class aop_list_borg
	extends aop_object
	implements Iterator {

	static $liste = array();
	
	/*********************************************************
	 * 				Iterator Interface
	 ********************************************************/
	public function count() {

		return count( self::$liste );
	}
	public function current() {

		return current( self::$liste );
	}
	public function key() {

		return key( self::$liste );
	}
	public function next() {

		return next( self::$liste );
	}
	public function rewind() {

		return rewind( self::$liste );
	}
	public function valid() {

		return ( valid( self::$liste) );
	}

	/*********************************************************
	 * 				Array Interface
	 ********************************************************/
	public function push( $element ) {
	
		self::$liste[] = $element;
		return $this;
	}

}//end definition
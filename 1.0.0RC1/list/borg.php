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
	
	public function __construct() {
		parent::__construct();
	}
	
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
	public function push( &$element ) {
	
		self::$liste[] = $element;
		return $this;
	}
	/**
	 * Returns the list
	 * @return array
	 */
	public function getList() {
		return self::$liste;
	}
	/**
	 * Merges object elements on the list.
	 * If an array of array(s) is presented, it is
	 * decomposed and merged.
	 * 
	 * @param mixed array of objects
	 * @return $this
	 */
	public function merge( &$elements ) {
	
		foreach( $elements as $index => &$element ) {
		
			if ( is_array( $element ))
				$this->merge( $element );
			else
				$this->push( $element );
		}
	
		return $this;
	}
	
}//end definition
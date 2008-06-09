<?php
/**
 * aop_iterator
 * PHP-AOP framework
 * 
 * @author Jean-Lou Dupont
 * @package AOP
 * @category AOP
 */

class aop_iterator 
	implements Iterator {

	/**
	 * Index in source array
	 */
	var $index = null;
	/**
	 * Count of source array 
	 */
	var $count = 0;
	/**
	 * Reference to source array
	 */
	var $ref = null;
	/**
	 * Array of keys of source array
	 */
	var $keys = null;
	
	/**
	 * Constructor
	 * 
	 * @param $objectContainer reference to source object
	 * @param $arrayContainer name of array in source object 
	 */	
	public function __construct( &$objectContainer, $arrayContainer ) {
	
		$this->index = 0;
		$this->ref = $objectContainer->$arrayContainer;
		$this->keys = array_keys( $this->ref );
		$this->count = count( $this->ref );
	}
	
	/*********************************************************
	 * 				Iterator Interface
	 ********************************************************/
	public function count() {
		return $this->count;
	}
	public function current() {
		$a = $this->ref;		
		$k = $this->keys[ $this->index ];		
		return ( $a[ $k ] );
	}
	public function key() {
		return $this->keys[ $this->index ];
	}
	public function next() {
		return $this->index++;	
	}
	public function rewind() {
		return $this->index =0 ;	
	}
	public function valid() {
		return ( $this->index < $this->count );
	}

}//end definition

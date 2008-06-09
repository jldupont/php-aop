<?php
/**
 * aop_iterator
 * PHP-AOP framework
 * 
 * This class allows for iterating a specified array
 * in a specified object instance through a ''foreach'' statement.
 * 
 * @example 
 * 		class Container {
 * 			
 * 			var $interesting_array;
 * 		}
 * 
 * 		$container = new Container;
 * 		$iterator = new aop_iterator( $container, 'interesting_array' );
 * 		foreach( $iterator as $key => $value )
 * 			do_some_stuff( $key, $value );
 * 
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
	var $index = 0;
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
		
		// pre-compute for speed
		$this->ref = $objectContainer->$arrayContainer;		
		$this->count = count( $this->ref );

		// necessary overhead as PHP does not provide
		// an easy way to extract 1key at the time
		$this->keys = array_keys( $this->ref );
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

<?php
/**
 * aop_list
 * PHP-AOP framework
 * 
 * @author Jean-Lou Dupont
 * @package AOP
 * @category AOP
 */

class aop_list 
	extends aop_object
	implements Iterator {

	var $liste = array();
	
	/*********************************************************
	 * 				Iterator Interface
	 ********************************************************/
	public function count() {

		return count( $this->liste );
	}
	public function current() {

		return current( $this->liste );
	}
	public function key() {

		return key( $this->liste );
	}
	public function next() {

		return next( $this->liste );
	}
	public function rewind() {

		return rewind( $this->liste );
	}
	public function valid() {

		return ( valid( $this->liste) );
	}

	/*********************************************************
	 * 				Array Interface
	 ********************************************************/
	/**
	 * Pushes an element at the end of the list
	 * @param $element mixed
	 */
	public function push( $element ) {
	
		$this->liste[] = $element;
		return $this;
	}
	/**
	 * Pops the element at the end of the list
	 * @return $element mixed
	 */
	public function pop() {
		return array_pop( $this->liste );
	}
}//end definition

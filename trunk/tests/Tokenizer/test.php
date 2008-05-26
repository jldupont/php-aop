<?php
/*
 * @author Jean-Lou Dupont
 * 
 */

class A {

}


class B 
	extends A {

	var $v1 = null;
	
	/*
	 * @before CLASS::METHOD
	 */
	public function __construct() {
	
	}

	var $v2 = null;
	
}

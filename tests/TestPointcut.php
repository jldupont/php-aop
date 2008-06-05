<?php
/**
 * Test class
 * 
 * @author Jean-Lou Dupont
 */

class TestPointcut 
	extends aop_pointcut_definition {
	

	public function cut_id1() {
	
		return array(	'cp'	=> 'classname-pattern1', 
						'mp'	=> 'methodname-pattern1', 
						'am'	=> array(	'before'	=> 'before_method', 
											'after'	=> 'after_method' ) );
		
		
	}
	
	
	public function cut_id2() {

		return array(	'cp' 	=> 'classname-pattern1', 
						'mp'	=> 'methodname-pattern1', 
						'am'	=> array(	'before'	=> 'before_method', 
											'after'	=> 'after_method' ) );
	}
	/**
	 * Advice definition 'before'
	 */
	public function before_method() {
		
	}
	/**
	 * Advice definition 'after'
	 */
	public function after_method() {
		
	}
	
	
}
// instructs the pointcut_processor of which
// class defines the pointcuts in this file
return 'TestPointcut';
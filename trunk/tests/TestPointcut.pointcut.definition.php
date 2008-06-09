<?php
/**
 * TestPointcut test class
 * 
 * @author Jean-Lou Dupont
 * http://php-aop.googlecode.com/
 */

class TestPointcut_pointcuts #the suffix _pointcuts is mandatory

	extends aop_pointcut_definition {
	

	public function cut_id1() {
	
		return array(	'cp'	=> 'classname-pattern1', 
						'mp'	=> 'methodname-pattern1', 
						'am'	=> array(	'before'=> 'before_method', 
											'after'	=> 'after_method' ) );
		
		
	}
	
	
	public function cut_id2() {

		return array(	'cp' 	=> 'classname-pattern2', 
						'mp'	=> 'methodname-pattern2', 
						'am'	=> array(	'before'=> 'before_method', 
											'after'	=> 'after_method' ) );
	}
	
	public function cut_show() {

		return array(	'cp' 	=> '~',	#all classes 
						'mp'	=> 'show', 
						'am'	=> array(	'before'=> 'before_show', 
											'after'	=> 'after_show' ) );
	
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
	
	/**
	 * Advice definition 'before'
	 */
	public function before_show() {
		echo "#BEFORE\n";
	}
	/**
	 * Advice definition 'after'
	 */
	public function after_show() {
		echo "#AFTER\n";		
	}
	
}

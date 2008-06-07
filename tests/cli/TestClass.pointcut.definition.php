<?php
/**
 * TestPointcut test class
 * 
 * @author Jean-Lou Dupont
 */

class TestClass_pointcuts #the suffix _pointcuts is mandatory

	extends aop_pointcut_definition {

	public function cut_constructor() {

		return array(	'cp' 	=> 'TestClass', 
						'mp'	=> '__construct', 
						'am'	=> array(	'before'=> 'before_show', 
											'after'	=> 'after_show' ) );
	
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

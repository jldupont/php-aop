<?php
/**
 * TestPointcut test class
 * 
 * @author Jean-Lou Dupont
 * http://php-aop.googlecode.com/
 * http://www.ohloh.net/projects/php-aop
 */

class TestClass_pointcuts #the suffix _pointcuts is mandatory

	extends aop_pointcut_definition {

	/**
	 * Pointcut definition
	 *  Will be applied only to the constructor  
	 *  of the class "TestClass"
	 * 
	 *  The code contained in method "before_show" (below)
	 *  will be applied "before" (i.e. at the beginning) of
	 *  the constructor whilst "after_show" will be applied 
	 *  at the end of the method.
	 */
	public function cut_constructor() {

		return array(	'cp' 	=> 'TestClass', 
						'mp'	=> '__construct', 
						'am'	=> array(	'before'=> 'before_show', 
											'after'	=> 'after_show' ) );
	
	}
	
	/**
	 * Pointcut definition
	 *  Will be applied to *all* classes of the project 
	 *  but *only* to the method "show" when present in the said classes.  
	 * 
	 *  The code contained in method "before_show" (below)
	 *  will be applied "before" (i.e. at the beginning) of
	 *  the constructor whilst "after_show" will be applied 
	 *  at the end of the method.
	 */
	public function cut_show() {

		return array(	'cp' 	=> '~',	#all classes 
						'mp'	=> 'show', 
						'am'	=> array(	'before'=> 'before_show', 
											'after'	=> 'after_show' ) );
	
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

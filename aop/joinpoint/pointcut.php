<?php
/**
 * aop_pointcut
 * PHP-AOP framework
 * 
 * @author Jean-Lou Dupont
 * @package AOP
 * @category AOP
 */

class aop_pointcut 
	extends aop_object {

	var $className = null;
	
	var $methodName = null;
	
	var $style = null;
	
	const STYLE_BEFORE = 1;
	const STYLE_AFTER  = 2;
	const STYLE_AROUND = 3;
	
	public function __construct() {
		parent::__construct();
	}
	
}//end definition
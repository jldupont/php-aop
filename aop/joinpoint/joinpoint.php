<?php
/**
 * aop_joinpoint
 * PHP-AOP framework
 * 
 * @author Jean-Lou Dupont
 * @package AOP
 * @category AOP
 */

class aop_joinpoint 
	extends aop_object {

	var $src_className = null;
	
	var $src_methodName = null;
	
	var $tgt_className = null;
	
	var $tgt_methodName = null;
	
	var $style = null;
	
	const STYLE_BEFORE = 1;
	const STYLE_AFTER  = 2;
	const STYLE_AROUND = 3;
	
	public function __construct() {
		parent::__construct();
	}
	
}//end definition
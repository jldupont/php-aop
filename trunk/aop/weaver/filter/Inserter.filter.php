<?php
/**
 * PHP_Beautifier_Filter_Inserter_Template
 * PHP-AOP framework
 * 
 * This class extends PHP/Beautifier with "insertion" capabilities:
 * - add arbitrary code at the START of a method
 * - add arbitrary code at the END of a method
 * This functionality satisfies the requirement to have:
 * - "before" style pointcuts
 * - "after" style pointcuts
 * - "around" style pointcuts  => "before" + original code + "after"
 * 
 * @author Jean-Lou Dupont
 * @package AOP
 * @category AOP
 * @pattern Template Method
 */

class PHP_Beautifier_Filter_Inserter extends PHP_Beautifier_Filter_Inserter_Template
{
    public function __construct(PHP_Beautifier $oBeaut, $aSettings = array()) 
    {
        parent::__construct($oBeaut, $aSettings);
    }
	/**
	 * SIGNAL HANDLER
	 */
    public function signal_class_method_start() {
    
    }
   	/**
	 * SIGNAL HANDLER
	 */
    public function signal_class_method_end() {
    
    }
    
}

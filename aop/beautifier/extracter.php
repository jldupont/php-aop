<?php
/**
 * aop_beautifier_extracter
 * PHP-AOP framework
 * 
 * This class is meant to be used with aop_filter_extracter.
 * 
 * @author Jean-Lou Dupont
 * @package AOP
 * @category AOP
 */

class aop_beautifier_extracter
	extends PHP_Beautifier {
	
	/**
	 * List of class/method to extract
	 * @access private
	 */
	var $extractList = array();
	
	/**
	 * List of extracted class/method
	 * @access private
	 */
	var $extractedList = array();
	
	/**
	 * 'Extract all' flag
	 */
	var $all = false;
	
	/**
	 * Adds an entry to the list of methods to extract
	 * 
	 * @param $classe
	 * @param $method
	 * @return $this 
	 */
	public function addExtractEntry( $classe, $method ) {
	
		$entry = array( 'c' => $classe, 'm' => $method );
		$this->extractList[] = $entry;
		return $this;
	}
	/**
	 * Sets the 'extract all' flag
	 * 
	 * @package boolean
	 * @return $this
	 */
	public function setAll( $flag = true ) { 
		$this->all = $flag;
		return $this;
	}
	
	/**
	 * Adds a token collector object
	 * to the list of extracted things.
	 * Called by aop_filter_extracter.
	 * 
	 * @param $obj aop_token_collector
	 * @return void
	 */
	public function commit( &$obj ) {
	
		if ( is_null( $obj ))
			return;
			
		$this->extractedList[] = $obj;
	}
	/**
	 * Returns the list of extracted tokens
	 */
	public function getExtractedList() {
		return $this->extractedList;
	}
	
	/**
	 * Returns an aop_token_collector object when there
	 * are tokens to collect
	 */
	public function getMatching( &$classe, &$method ) {
	
		$found = null;

		// only go through the lenghty process if we really need to
		if ( !$this->all )
			foreach( $this->extractList as $entry ) {
				if ( $entry['c'] == $classe )
					if ( $entry['m'] == $method ) {
						$found = $entry;
						break;
					}
			}
		// we found a match, supply a collector
		if ( !is_null( $found ) or $this->all ) {
			#return new aop_token_collector( $classe, $method );
			return aop::factory( 'aop_token_collector', $classe, $method );
		}
		
		return null;
	}
	
}//end class
<?php
/**
 * aop_beautifier_extracter
 * PHP-AOP framework
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
	 * Adds a token collector object
	 * to the list of extracted things
	 * 
	 */
	public function commit( &$obj ) {
	
		if ( is_null( $obj ))
			return;
			
		$this->extractedList[] = $obj;
	}
	
	public function getExtractedList() {
		return $this->extractedList;
	}
	
	/**
	 * Returns an aop_token_collector object when there
	 * are tokens to collect
	 */
	public function getMatching( &$classe, &$method ) {
	
		$found = null;
		foreach( $this->extractList as $entry ) {
			if ( $entry['c'] == $classe )
				if ( $entry['m'] == $method ) {
					$found = $entry;
					break;
				}
		}
		// we found a match, supply a collector
		if ( !is_null( $found ) ) {
			return new aop_token_collector( $classe, $method );
		}
		
		return null;
	}
	
}//end class
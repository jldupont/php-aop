<?php
/**
 * aop_weaver class
 * PHP-AOP framework
 * 
 * @author Jean-Lou Dupont
 * @package AOP
 * @category AOP
 */

class aop_weaver 
	extends aop_object {

	/**
	 * Filename pattern of 'weaved' files
	 */
	static $filePattern = '%1.aspect.php';
	
	/**
	 * Pointcut list
	 * @access public
	 */
	var $pointcuts = array();
	
	/**
	 * Constructor 
	 */
	public function __construct() {
	}
	
	/**
	 * Sets the list of pointcuts 
	 */
	public function setPointcuts( &$pointcuts ) {
	
		$this->pointcuts = $pointcuts;
		return $this;
	}
	
	/**
	 * Verifies if a 'weaved' representation of the specified
	 * class already exists.
	 *  
	 * @param $classPath string
	 * @return $result boolean
	 * @throws aop_weaver_exception
 	 */
	public function isWeaved( &$classPath ) {
	
		$weaved_file = str_replace( '%1', $classPath, self::$filePattern );
		
		//if weaved file does not exist yet
		if ( !file_exists( $weaved_file ) )
			return false;
			
		//the weaved file exists... but is it up-to-date?
		$mtime_source_file = filemtime( $classPath   );
		$mtime_weaved_file = filemtime( $weaved_file );
		
		if ( $mtime_weaved_file === false || $mtime_source_file === false )
			return false;
			
		return ( $mtime_weaved_file > $mtime_source_file );
	}
	/**
	 * Performs 'weaving' on the specified class
	 * 
	 * @param $classPath string
	 * @return $result boolean
	 * @throws aop_weaver_exception
	 */
	public function weave( &$classPath ) {
	
	}
	
}//end definition
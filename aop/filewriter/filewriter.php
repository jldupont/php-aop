<?php
/**
 * aop_filewriter class
 * PHP-AOP framework
 * 
 * @author Jean-Lou Dupont
 * @package AOP
 * @category AOP
 */

class aop_filewriter
	extends aop_object {
	
	/**
	 * fileObj
	 * @access private
	 */
	private var $fileObj = null;
	
	/**
	 * Constructor
	 * @param $fileObj object of aop_file class
	 */
	public function __construct( &$fileObj ) {
		if (!( $fileObj instance aop_file ))
			throw new aop_filewriter_exception( "expecting an aop_file object instance" );
			
		$this->fileObj = $fileObj;
		
		parent::__construct();
	}
	
	/**
	 * Write the fileObj to the specified $path
	 * 
	 * @param $path string filename path
	 * @return $result boolean
	 * @throws aop_filewrite_exception
	 */
	public function writeToFile( &$path ) {
	
	}
	
}//end definition
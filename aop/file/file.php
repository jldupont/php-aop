<?php
/**
 * aop_file
 * PHP-AOP framework
 * 
 * 
 * @author Jean-Lou Dupont
 * @package AOP
 * @category AOP
 * @pattern TemplateMethod
 */

abstract class aop_file
	extends aop_object {

	/**
	 * 
	 */
	var $path = null;
	
	/**
	 * 
	 */
	var $path_parts = null;
	
	/**
	 * 
	 */	
	var $mtime = null;	

	/**
	 * 
	 */
	var $content = null;
	
	// =======================================================================
	//							PUBLIC INTERFACE
	// =======================================================================
	
	public function __construct( &$path, &$content = null ) {
	
		$this->path = $path;
		$this->content = $content;
		parent::__construct();
		
		$this->init();
	}
	/**
	 * Verifies if the given path exists
	 * Records the 'modified timestamp' in the process
	 * 
	 * @return boolean
	 */
	public function exists() {
	
		return $this->mtime !== false;
	}
	/**
	 * Process the file
	 * 
	 * @return boolean result
	 * @throws aop_file_exception
	 */
	public function process() {
	
		if ( empty( $this->content )) {
	
			// read content + aspect definition
			if ( $this->read() === false )
				$this->raise( 'aop_file_exception', "can't read file" );
		}
		
		// make sure we have content to work on
		if (is_null( $this->content ) || ($this->content === false))
			$this->raise( 'aop_file_exception', "no content found" );

		try {
		
			$content = $this->_process();
			
		} catch( Exception $e ) {
		
			$this->raise( 'aop_file_exception', "can't process file. ".$e->getMessage() );
		}

		try {
		
			$result = $this->save( );
			
		} catch( Exception $e ) {
		
			$this->raise( 'aop_file_exception', "can't save file. ".$e->getMessage() );
		}
		
		return $result;
	}
	/**
	 * Returns pathinfo parts
	 * 
	 * @return mixed array
	 */
	public function getPathParts() {
	
		return $this->path_parts;
	}
	// =======================================================================
	//							DEFAULT TEMPLATE METHODS
	// =======================================================================

	abstract protected function _process();

	abstract protected function transformPath();	
	
	// =======================================================================
	//							PROTECTED METHODS
	// =======================================================================	

	/**
	 * Reads the content of the base file and
	 * determines where the __halt_compiler boundary lies
	 * 
	 * @return boolean
	 */
	protected function read() {
		
		$this->content = file_get_contents( $this->path );
				
		return ($this->content !== false);
	}
	/**
	 * Saves the representation to a file
	 * 
	 * @return boolean result
	 */
	protected function save( ) {
	
		$len = strlen( $this->content );
		
		$bytes_written = file_put_contents( $this->path, $this->content );
		
		return ( $len === $bytes_written );
	}

	/**
	 * Core method for the template method pattern
	 */
	private function init() {
	
		$this->transformPath();

		$this->fetchPathInfo();
		
		$this->fetch_mtime();
	}
	/**
	 * Pathinfo fetching
	 */
	protected function fetchPathInfo() {
	
		$this->path_parts = pathinfo( $this->path );
	}
	/**
	 * mtime fetching
	 */
	protected function fetch_mtime() {
	
		$this->mtime = filemtime( $this->path );	
	}
	
}//end definition
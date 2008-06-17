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
	 * Path
	 */
	var $path = null;
	
	/**
	 * Pathinfo array
	 */
	var $path_parts = null;
	
	/**
	 * mtime (modification timestamp)
	 */	
	var $mtime = null;	

	/**
	 * File contents
	 */
	var $content = null;
	
	// =======================================================================
	//							PUBLIC INTERFACE
	// =======================================================================
	
	public function __construct( &$path, &$content = null ) {
	
		$this->init( $path, $content );
		
		parent::__construct();
		
	}
	/**
	 * Returns the content
	 * 
	 * @return string
	 */
	public function getContent() {
	
		return $this->content;
	}
	/**
	 * Sets the content
	 */
	public function setContent( &$content = null ) {
		$this->content = $content;
		return $this;
	}
	/**
	 * Returns the mtime field associated with the path file
	 * 
	 * @return integer mtime
	 */
	public function get_mtime() {
	
		return $this->mtime;
	}
	/**
	 * Verifies if the given path exists
	 * Records the 'modified timestamp' in the process
	 * 
	 * @return boolean
	 */
	public function exists() {
	
		return ($this->mtime !== false) and ($this->mtime !== null);
	}
	/**
	 * Process the file
	 * 
	 * @return boolean result
	 * @throws aop_file_exception
	 */
	public function process() {
	
		if ( empty( $this->content )) {
	
			// can be handled in derived class
			if ( $this->read() === false )
				$this->raise( 'aop_file_exception', "can't read file" );
		}
		
		// make sure we have content to work on
		if (is_null( $this->content ) || ($this->content === false))
			$this->raise( 'aop_file_exception', "no content found" );

		try {
		
			// handled in derived class
			$content = $this->_process( $this->content );
			
		} catch( Exception $e ) {
		
			$this->raise( 'aop_file_exception', "can't process file. ".$e->getMessage() );
		}

		try {
			// can be handled in derived class		
			$result = $this->write( $content );
			
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
	public function getPath() {
		return $this->path;
	}
	// =======================================================================
	//							DEFAULT TEMPLATE METHODS
	// =======================================================================

	abstract protected function _process( &$content = null );

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
	protected function write( &$content ) {
	
		$len = strlen( $content );
		
		$bytes_written = file_put_contents( $this->path, $content );
		
		return ( $len === $bytes_written );
	}

	/**
	 * Core method for the template method pattern
	 * 
	 * @see aop_factory
	 */
	protected function init( &$path, &$content = null ) {
	
		$this->path = $path;
		$this->content = $content;
		$this->path_parts = null;
		
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
		if ( !file_exists( $this->path )) {
			$this->mtime = null;
			return;
		}
			
		try {
			$this->mtime = @filemtime( $this->path );
		} catch( Exception $e ) {
			$this->mtime = null;	
		}
	}
	
}//end definition
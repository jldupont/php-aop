<?php
/**
 * aop_file_definition
 * PHP-AOP framework
 * 
 * Pointcut definition file
 * 
 * @author Jean-Lou Dupont
 * @package AOP
 * @category AOP
 * @pattern TemplateMethod
 */

abstract class aop_file_definition
	extends aop_file {

	static $suffix = 'pointcut.definition.php';
	
	// =======================================================================
	//							PUBLIC INTERFACE
	// =======================================================================
	
	public function __construct( &$path, &$content = null ) {
	
		parent::__construct( $path, $content );
	}
	
	// =======================================================================
	//							TEMPLATE METHODS
	// =======================================================================
	
	/**
	 * Process the file
	 * 
	 * @return boolean result
	 * @throws aop_file_exception
	 */
	public function _process() {

		
		return $result;
	}

	/**
	 * Transform the source path to the desired path for the pointcut
	 * definition file
	 */
	protected function transformPath() {
		
		$this->path = str_replace( '.php', self::$suffix, $this->path );
	}
	// =======================================================================
	//							SUB-CLASSED METHODS
	// =======================================================================
		
	/**
	 *  
	 */
	public function save() {
	
	}
	
	
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
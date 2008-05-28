<?php
/**
 * aop_file
 * PHP-AOP framework
 * 
 * 
 * @author Jean-Lou Dupont
 * @package AOP
 * @category AOP
 */

class aop_file
	extends aop_list {

	const WEAVED_PATH_PATTERN     = '.weaved.php';
	
	const BEAUTIFIED_PATH_PATTERN = '.beautified.php';
	
	var $path = null;
	var $beautified_path = null;
	var $weaved_path = null;
	
	var $mtime = null;	
	var $weaved_mtime = null;

	var $content = null;
	var $content_beautified = null;
	
	var $tokens  = null;
	
	public function __construct( &$path, &$content = null ) {
	
		$this->path = $path;
		$this->content = $content;
	
		parent::__construct();
	}
	/**
	 * Verifies if a 'weaved' version of the file exists
	 * Records the 'mtime' of the weaved file in the process
	 * 
	 * @return boolean 
	 */
	public function existsWeaved( ) {
	
		if ( !is_null( $this->weaved_mtime ) )
			return $this->weaved_mtime !== false;
			
		$exists = $this->exists();
		if ( !$exists )
			return false;
		
		// simple and quick
		$weavedFilePath = str_replace( '.php', self::WEAVED_PATH_PATTERN, $this->path );
		
		$this->weaved_mtime = filemtime( $weavedFilePath );

		return $this->weaved_mtime !== false;
	}
	/**
	 * Returns the file path for the 'beautified' version
	 * of the current file
	 * 
	 * @return $path string
	 */
	public function getBeautifiedPath() {
	
		if (empty( $this->path ))
			throw new aop_file_exception( "invalid path" );
	
		if ( !is_null( $this->beautified_path ))
			return $this->beautified_path;

		// simple and quick
		$this->beautifiedPath = str_replace( '.php', self::BEAUTIFIED_PATH_PATTERN, $this->path );
			
		return $this->beautifiedPath;	
	}
	/**
	 * Verifies if the given path exists
	 * Records the 'modified timestamp' in the process
	 * 
	 * @return boolean
	 */
	public function exists() {
	
		if ( !is_null( $this->mtime ) )
			return $this->mtime !== false;
			
		$this->mtime = filemtime( $this->path );
		
		return $this->mtime !== false;
	}
	/**
	 * Process the file
	 * 
	 * @return $this
	 * @throws aop_file_exception
	 */
	public function process() {
	
		if ( empty( $this->content )) {
	
			// read content + aspect definition
			if ( $this->readFile() === false )
				throw new aop_file_exception( "can't read file" );
		}
		
		// make sure we have content to work on
		if (is_null( $this->content ) || ($this->content === false))
			throw new aop_file_exception( "no content found" );

		// beautifies the source file to help the parser
		$this->generateBeautified();			

		// tokenize
		try {
		
			$this->tokenize();
			
		} catch( Exception $e ) {
		
			throw new aop_file_exception( "can't tokenize file" );
		}
		
		return $this;
	}
	/**
	 * Returns the classes defined in this file
	 * 
	 * @return $classes array from PHP_Parser_Core
	 */
	public function getClasses() {
	
		if ( isset( $this->tokens['classes'] ) )
			return $this->tokens['classes']
	
		return null;
	}
	
	// =======================================================================
	//							PROTECTED METHODS
	// =======================================================================	
	
	
	/**
	 * Tokenize the content
	 * 
	 * @return $tokens
	 * @throws aop_file_exception
	 */
	protected function tokenize() {
		
		$this->tokens = PHP_Parser::parse( $this->content_beautified );
	}
	/**
	 * Reads the content of the base file and
	 * determines where the __halt_compiler boundary lies
	 * 
	 * @return boolean
	 */
	protected function readFile() {
		
		$this->content = file_get_contents( $this->path );
				
		return ($this->content !== false);
	}
	/**
	 * Generates a 'beautified' version of the base file
	 * This step helps PHP_Parser and reduces the potential for errors
	 * 
	 * @return $this
	 * @throws aop_file_exception
	 */
	protected function generateBeautified() {

		try {
		
			$oBeaut = new PHP_Beautifier();
			
			$oBeaut->addFilter('NewLines');			
			$oBeaut->addFilter('IndentStyles');			
			$oBeaut->addFilter('ArrayNested');
			$oBeaut->addFilter('ListClassFunction');
		
			$oBeaut->setInputString( $this->content );
			$oBeaut->process();
			
			$this->content_beautified = $oBeaut->get();
			
		} catch( Exception $e ) {

			throw new aop_file_exception( "beautifier process failed" );	
		}
	
		return $this;
	}
	
	
}//end definition
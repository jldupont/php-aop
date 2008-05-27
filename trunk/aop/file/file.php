<?php
/**
 * aop_file
 * PHP-AOP framework
 * 
 * - create from class file
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
	var $mtime = null;

	var $beautified_path = null;
	
	var $weaved_path = null;
	var $weaved_mtime = null;

	var $content = null;
	
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
	 * 
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
	 * Creates an instance of this class based on an
	 * input file.
	 * 
	 * @return $object
	 * @throws aop_file_exception
	 */
	public static function newFromFile( &$path ) {
	
		$content = file_get_contents( $path );
		if ( $content === false )
			throw new aop_file_exception( "error reading file from $path" );
		
		return new aop_file( $path, $content );
	}
	/**
	 * Tokenize the content
	 * 
	 * @return $this
	 * @throws aop_file_exception
	 */
	public function tokenize() {
		
		if (empty( $this->content ))
			$this->readFile();
	
		if (is_null( $this->content ) || ($this->content === false))
			throw new aop_file_exception( "no content found" );
			
		$this->liste = token_get_all( $this->content );
		return $this;	
	}
	/**
	 * Reads the content of the base file
	 * 
	 * @return boolean
	 */
	public function readFile() {
	
		$this->contents = file_get_contents( $this->path );
		return $this->contents !== false;
	}
	/**
	 * Updates a specific index in the token list
	 * with a 'aop_tokenlist' object.
	 * Usually, the token found at $index should have been read
	 * by the client and inserted in the client's list in order
	 * not to loosed token.
	 * 
	 * @param $index integer position in the original list
	 * @param $liste aop_tokenlist object instance
	 * @return $this
	 * @throws aop_file_exception
	 */
	public function insertTokenList( $index, &$liste ) {
	
		if ( !isset( $this->liste[ $index ] ))
			throw new aop_file_exception( "invalid index position" );
		
		if (!( $liste instanceof aop_tokenlist ))
			throw new aop_file_exception( "expecting a 'aop_tokenlist' object" );
			
		$this->liste[$index] = $liste;
		return $this;
	}
	/**
	 * Generates a 'beautified' version of the base file
	 * This step helps PHP_Parser and reduces the potential for errors
	 * 
	 * @return $this
	 * @throws aop_file_exception
	 */
	public function generateBeautified() {

		try {
		
			$oBeaut = new PHP_Beautifier();
			$oBatch = new PHP_Beautifier_Batch($oBeaut);
			
			$oBatch->addFilter('NewLines');			
			$oBatch->addFilter('IndentStyles');			
			$oBatch->addFilter('ArrayNested');
			$oBatch->addFilter('ListClassFunction');
		
			$oBatch->setOutputFile( $this->getBeautifiedPath() );
			$oBatch->setInputFile( $this->path );
			$oBatch->process();
			$oBatch->save();
			
		} catch( Exception $e ) {
			echo __METHOD__." exception!";
			throw new aop_file_exception( "beautified process failed" );	
		}
	
		return $this;
	}
	
	
}//end definition
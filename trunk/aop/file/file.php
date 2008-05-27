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
	
	var $path = null;
	var $content = null;
	
	public function __construct( &$path, &$content ) {
	
		$this->path = $path;
		$this->content = $content;
	
		parent::__construct();
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
		
		if (is_null( $this->content ))
			throw new aop_file_exception( "no content found" );
			
		$this->liste = token_get_all( $this->content );
		return $this;	
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
	

}//end definition
<?php
/**
 * aop_aspect_file
 * PHP-AOP framework
 * 
 * 
 * @author Jean-Lou Dupont
 * @package AOP
 * @category AOP
 */

class aop_aspect_file

	extends aop_aspect_definition {

	public function __construct( $path ) {
	
		$content = file_get_contents( $path );
		
		try {
		
			$result = $this->parse( $contents );
			
		} catch( Exception $e ) {
		
			$this->raise( 'aop_aspect_file_exception', "can't parse the definition file" );
		}

		parent::__construct();
	}
	
	
	
}//end definition
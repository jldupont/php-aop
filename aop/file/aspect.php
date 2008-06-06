<?php
/**
 * aop_file_aspect
 * PHP-AOP framework
 * 
 * Aspect file
 * 
 * @author Jean-Lou Dupont
 * @package AOP
 * @category AOP
 * @pattern TemplateMethod
 */

class aop_file_aspect
	extends aop_file_source {

	static $suffixAspect = '.aspect.php';
	
	// =======================================================================
	//							PUBLIC INTERFACE
	// =======================================================================
	
	/**
	 * Constructor
	 * 
	 */	
	public function __construct( &$path, &$content = null ) {
	
		parent::__construct( $path, $content );
	}
	
	/**
	 * From the base class
	 */
	public static function getTransformationPathString() {
	
		return self::$suffixAspect;
	}
	// =======================================================================
	//							TEMPLATE METHODS
	// =======================================================================
	
	/**
	 * Processes the file
	 * 
	 * @return boolean result
	 * @throws aop_file_exception
	 */
	public function _process( &$content ) {

		return $content;
	}

	/**
	 * Transform the source path to the desired path for the pointcut
	 * definition file
	 */
	protected function transformPath() {
		
		$this->path = str_replace( '.php', self::$suffixAspect, $this->path );
	}
	// =======================================================================
	//							SUB-CLASSED METHODS
	// =======================================================================
		

}//end definition
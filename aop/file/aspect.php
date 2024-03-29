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
	extends aop_file {

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
	public function _process( &$content = null ) {
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
	public function write( &$content = null ) {
		return parent::write( $content );
	}

	/**
	 * @see aop_factory
	 */
	public function init( &$path, &$content = null ) {
		return parent::init( $path, $content );
	}
	
	/**
	 * isRecyclable
	 *  Should be redefine in derived classes.
	 * 
	 * @see aop_object
	 */
	public function isRecyclable() {
		return true;
	}
	
}//end definition
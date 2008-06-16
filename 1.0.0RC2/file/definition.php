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

class aop_file_definition
	extends aop_file {

	static $suffix = '.pointcut.definition.php';
	
	var $pointcuts = null;
	
	// =======================================================================
	//							PUBLIC INTERFACE
	// =======================================================================
	
	public function __construct( &$path, &$content = null ) {
	
		parent::__construct( $path, $content );
	}
	
	public static function getTransformationPathString() {
	
		return self::$suffix;
	}
	// =======================================================================
	//							TEMPLATE METHODS
	// =======================================================================
	
	/**
	 * Processes the file
	 * The user of this class should call the 'exists()' method
	 * before 'process()' the file.
	 * 
	 * @return boolean result
	 * @throws aop_file_exception
	 */
	public function _process( &$content = null ) {

    	$proc = aop::factory( 'aop_pointcut_processor', $this->path );
    	
    	return $proc->process();
	}

	/**
	 * Transform the source path to the desired path for the pointcut
	 * definition file
	 */
	protected function transformPath() {
		
		// check if the suffix is already present
		if ( strpos( $this->path, self::$suffix ) === false )
			$this->path = str_replace( '.php', self::$suffix, $this->path );
	}
	// =======================================================================
	//							SUB-CLASSED METHODS
	// =======================================================================
		
	/**
	 *  write
	 * 
	 * @param $content string content
	 * @see aop/file.php
	 */
	protected function write( &$content ) {
		
		$this->pointcuts = $content;
	
		$pointcutsStore = aop::factory( 'aop_pointcut_list' );
		
		$pointcutsStore->merge( $this->pointcuts );

		// this can only fail for reasons beyond
		// our control here.
		return true;
	}
	
}//end definition
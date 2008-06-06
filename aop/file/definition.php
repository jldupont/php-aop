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
	public function _process() {

    	$proc = aop::factory( 'aop_pointcut_processor', $this->path );
    	
    	$this->pointcuts = $proc->process();
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
		
		$pointcutsStore = aop::factory( 'aop_pointcut_list' );
		
		$pointcutsStore->push( $this->pointcuts );

		// this can only fail for reasons beyond
		// our control here.
		return true;
	}
	
	
	// =======================================================================
	//							PROTECTED METHODS
	// =======================================================================	
	
}//end definition
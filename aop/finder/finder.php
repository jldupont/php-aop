<?php
/**
 * finder class
 *  This class is used to 'find' class implementation through
 *  the registered class paths.
 * 
 * PHP-AOP framework
 * 
 * @author Jean-Lou Dupont
 * @package AOP
 * @category AOP
 */

class aop_finder 
	implements aop_singleton {

	/**
	 * Singleton instance variable
	 * @access private
	 */
	private static $instance = null;
	
	/**
	 * Class paths array
	 * @access public
	 */
	var $paths = null;
	
	/**
	 * Singleton pattern
	 */
	protected function __construct(){}
	
	public static function singleton() {
	
		if (!is_null( self::$instance ))
			return self::$instance;
	
		$classe = __CLASS__;
		return (self::$instance = new $classe);
	}
	/**
	 * @param $paths path list array
	 * @return $this
	 */
	public function setPaths( &$paths ) {
	
		$this->paths = $paths;
		return $this;
	}
	/**
	 * find a specific class in the path hierarchy
	 * 1- as $path/$className.php
	 * 2- as $path/$className/$className.php
	 * 3- as $path/$className-fragment1 ... /$className-fragment-last.php
	 * 
	 * @param $className string class name
	 * @return $path string
	 */
	public function find( &$className ) {
	
		if (empty( $this->paths ))
			throw new aop_exception( "path list is empty" );
	
		foreach( $this->paths as $path ) {
		
			// case 1
			$p = $path . PATH_SEPARATOR . $className . '.php';
			if ( file_exists( $p ) )
				return $p;
				
			// case 2
			$p = $path . PATH_SEPARATOR . $className . PATH_SEPARATOR . $className . '.php';
			if ( file_exists( $p ) )
				return $p;
				
			// case 3
			$bits = explode( "_", $className );
			$fragment = implode( PATH_SEPARATOR, $bits );
			$p = $path . PATH_SEPARATOR . $fragment . '.php';
			if ( file_exists( $p ) )
				return $p;
		}
		
		return null;
	}
	
}//end definition
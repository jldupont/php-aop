<?php
/**
 * aop_finder
 *  This class is used to 'find' class implementations through
 *  the registered class paths.
 * 
 * PHP-AOP framework
 * 
 * @author Jean-Lou Dupont
 * @package AOP
 * @category AOP
 * @pattern borg
 */

class aop_finder {

	/**
	 * Singleton instance variable
	 * @access private
	 */
	private static $instance = null;
	
	/**
	 * Class paths array
	 * @access public
	 */
	static $paths = array();
	
	/**
	 * Constructor
	 */
	public function __construct(){}
	
	/**
	 * Adds a path to the list
	 * 
	 * @param $path string path to add
	 * @return $this
	 */
	public function addClassPath( &$path ) {
	
		if ( in_array( $path, self::$paths ))
			return $this;
			
		self::$paths[] = $path;
		
		return $this;
	}
	/**
	 * find a specific class in the path hierarchy
	 * 1- as $path/$className.php
	 * 2- as $path/$className/$className.php
	 * 3- as $path/$className-fragment1 ... /$className-fragment-last.php
	 * 4- as $path/$className-fragment1 ... /$className-fragment-last/$className-fragment-last.php
	 * 
	 * @param $className string class name
	 * @return $path string
	 * @throws
	 */
	public function find( &$className ) {
	
		if (empty( self::$paths ))
			throw new aop_exception( "path list is empty" );
	
		foreach( self::$paths as $path ) {
		
			// case 1
			$p = $path . DIRECTORY_SEPARATOR . $className . '.php';
			#echo "1- Trying path: $p \n";
			if ( file_exists( $p ) )
				return $p;
				
			// case 2
			$p = $path . DIRECTORY_SEPARATOR . $className . DIRECTORY_SEPARATOR . $className . '.php';
			#echo "2- Trying path: $p \n";		
			if ( file_exists( $p ) )
				return $p;
				
			// case 3
			$bits = explode( "_", $className );
			$fragment = implode( DIRECTORY_SEPARATOR, $bits );
			$last_fragment = $bits[ count( $bits ) - 1 ];
			$p = $path . DIRECTORY_SEPARATOR . $fragment . '.php';
			#echo "3- Trying path: $p \n";			
			if ( file_exists( $p ) )
				return $p;
			
			// case 4
			$p = $path . DIRECTORY_SEPARATOR . $fragment . DIRECTORY_SEPARATOR.$last_fragment.'.php';
			#echo "4- Trying path: $p \n";			
			if ( file_exists( $p ) )
				return $p;
		}
		
		return null;
	}
	
}//end definition
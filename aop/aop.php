<?php
/**
 * PHP-AOP framework
 * This class is implemented as static for ease of use: no instance
 * of this class need to be created. Furthermore, the typical usage
 * involves a straightforward and explicit implementation:
 * @example
 *   require_once "aop/aop.php";
 *   aop::register_class_path( dirname(__FILE__) . DIRECTORY_SEPARATOR . 'classes' ); 
 * 
 * The framework searches for class files through its 'aop_finder' class.
 * When the required class file is located, the framework then looks for
 * a 'weaved' version of the said class file. If the 'weaved' version of the
 * class file does not exist, the framework proceeds to 'weaving' the 
 * class file following the instructions contained inside the original (i.e.
 * non-weaved) class file.
 * 
 * 
 * @author Jean-Lou Dupont
 * @package AOP
 * @category AOP
 * @pattern borg
 * @pattern factory
 */

class aop {

	/**
	 * Activation state
	 * @access private
	 */
	private static $activated = false;

	/**
	 * Reference list of allowed parameters
	 * @access public 
	 */
	static $refParams = array(
	);	

	/**
	 * Class parameters
	 * @access private
	 */
	private static $params = array();
	
	/**
	 * Class map for the factory
	 * @access private
	 */
	private static $classMap = array();
	
	/*================================================================
	 					PUBLIC INTERFACE
	 ================================================================*/
	/**
	 * Constructor (borg pattern)
	 */
	public function __construct() {
	
		self::activate();
	}
	
	/**
	 * @see aop::_register_class_path 
	 */
	public function register_class_path( $path ) {
	
		return self::_register_class_path( $path );
	}
	
	/**
	 * register_class_path
	 * Register a filesystem path where class definition can be found
	 * 
	 * @param $path filesystem path (either absolute or relative)
	 * @return $result boolean
	 */
	public static function _register_class_path( $path ) {
	
		$finder = new aop_finder;
		$finder->addClassPath( $path );
		
		return true;
	}
	/**
	 * Maps a class to another one
	 * Used along with the factory interface.
	 * 
	 * @param $oClasse string original class
	 * @param $rClasse string replacement class
	 * @return void
	 */
	public static function mapClass( $oClasse, $rClasse ) {
	
		self::$classMap[ $oClasse ] = $rClasse;
	}
	/**
	 * factory
	 * 
	 * @param $className name of class to instantiate/get (singleton)
	 * @param mixed optional parameters
	 * @return $object
	 */
	public static function factory( $className /*optional params*/ ) {
	
		$args = func_get_args();
		array_shift( $args );	#$classname
	
		// check our replacement map
		if ( isset( self::$classMap[$className] )) {
		
			$classe = self::$classMap[$className];
			if ( !class_exists( $classe ))
				throw new aop_exception( "unable to load class ($className) remapped to ($classe)" );
			
			$className = self::$classMap[$className]; 
			return self::buildObject( $className, $args );
		}
	
		// default i.e. no remapping
		if ( !class_exists( $className, true ))
			throw new aop_exception( "unable to load class $className" );
			
		return self::buildObject( $className, $args );
	}
	
	/**
	 * Parameter SETTER
	 * 
	 * @param $key parameter name
	 * @param $value parameter value
	 * @return void
	 * @throws aop_exception 
	 */
	public static function setParam( $key, $value ) {
	
		if ( !in_array( $key, self::$refParams ))
			throw new aop_exception( "invalid parameter key $key" );
			
		self::$params[$key] = $value;	
	}
	/**
	 * Parameter GETTER
	 * 
	 * @param $key parameter name
	 * @return $value parameter value
	 * @throws aop_exception 
	 */
	public static function getParam( $key ) {
		
		if ( !isset( self::$params[ $key ] ) )
			throw new aop_exception( "invalid parameter key $key" );
			
		return ( self::$params[ $key ] );
	}
	
	/*================================================================
	 					PRIVATE INTERFACE
	 ================================================================*/
	/**
	 * Builds an object instance of the specified class
	 * and passes properly a variable argument list
	 * 
	 * @param $classe
	 * @param $args mixed
	 * @return $object
	 * @throws aop_exception when too many arguments are passed in array $args
	 */
	private static function buildObject( &$classe, Array &$args ) {
	
		$count = count( $args );
		
		switch( $count ) {
		case 0:
			return new $classe;
		case 1:
			return new $classe( $args[0] );
		case 2:
			return new $classe( $args[0], $args[1] );
		case 3:
			return new $classe( $args[0], $args[1], $args[2] );
		case 4:
			return new $classe( $args[0], $args[1], $args[2], $args[3] );
		default:
			throw new aop_exception( "unsupported number of arguments whilst creating object in factory" );
		}
	}
	
	/**
	 * Framework activation function
	 * 
	 * @return void
	 */
	public static function activate() {

		// activate just once
		if ( self::$activated )
			return;
			
		self::$activated = true;
		
		require_once 'PHP/Parser.php';
		require_once 'PHP/Beautifier.php';
		require_once 'PHP/Beautifier/Batch.php';
		
		require_once "aop_exception.php";
		require_once dirname(__FILE__) . DIRECTORY_SEPARATOR ."finder".DIRECTORY_SEPARATOR."finder.php";

		$callback = array( __CLASS__, 'our_autoload' );
		spl_autoload_register( $callback );
		
		$callback = array( __CLASS__, 'autoload' );
		spl_autoload_register( $callback );
	}
	/**
	 * Autoloads classes making this framework
	 */
	public static function our_autoload( $className ) {
	
		if (substr( $className, 0, 4) != 'aop_' )
			return false;
			
		$finder = new aop_finder;
		$path = $finder->find( $className );
		if ( is_null( $path ))
			return false;
			
		include $path;

		return ( class_exists( $className ));
	}
	/**
	 * Autoload function
	 * 
	 * @param $className the name of the class to load and process
	 * @return void
	 */
	public static function autoload( $className ) {

		$finder = new aop_finder;
	
		//find the target class file
		$path = $finder->find( $className );
		if ( is_null( $path ))
			return false;

		$result = include $path;
		if ( !$result )
			return false;
		
		if ( !class_exists( $className ))
			return false;

		// get the class file ready
		#$file = new aop_file( $path );
		#$file->process();
		
		#var_dump( $file );
		
			
		//process it
		
		return true;
	}
	
}//end definition

//activate the framework
aop::activate();
aop::register_class_path( get_include_path() );
aop::register_class_path( 
	realpath( dirname( __FILE__ ).DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR ) );
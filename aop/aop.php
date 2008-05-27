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
	
	/*================================================================
	 					PUBLIC INTERFACE
	 ================================================================*/
	
	/**
	 * register_class_path
	 * Register a filesystem path where class definition can be found
	 * 
	 * @param $path filesystem path (either absolute or relative)
	 * @return $result boolean
	 */
	public static function register_class_path( $path ) {
	
		$finder = aop_finder::singleton()->addClassPath( $path );
		
		return true;
	}
	/**
	 * factory
	 * 
	 * @param $className name of class to instantiate/get (singleton)
	 * @return $object
	 */
	public static function factory( $className ) {
	
		if ( !class_exists( $className, true ))
			throw new aop_exception( "unable to load class $className" );
			
		// check if the target class implements a singleton interface
		$singletonMethod = array( $className, 'singleton' );
		if ( is_callable( $singletonMethod ))
			return call_user_func( $singletonMethod );
			
		return new $className;
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
	 * Framework activation function
	 * 
	 * @return void
	 */
	public static function activate() {

		// activate just once
		if ( self::$activated )
			return;
			
		self::$activated = true;
		
		require_once "aop_exception.php";
		require_once "aop_singleton.php";
		require_once dirname(__FILE__) . DIRECTORY_SEPARATOR ."finder".DIRECTORY_SEPARATOR."finder.php";
		
		$callback = array( __CLASS__, 'autoload' );
		spl_autoload_register( $callback );
	}
	/**
	 * Framework's autoload function
	 * 
	 * @param $className the name of the class to load and process
	 * @return void
	 */
	public static function autoload( $className ) {
	
		$finder = aop_finder::singleton();
	
		//find the target class file
		$path = $finder->find( $className );
		$result = include $path;
		if ( !$result )
			return false;
		
		if ( !class_exists( $className ))
			return false;
			
		//process it
		
		return true;
	}
	
}//end definition

//activate the framework
aop::activate();
aop::register_class_path( 
	realpath( dirname( __FILE__ ).DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR ) );
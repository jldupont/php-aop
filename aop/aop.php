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
 * http://php-aop.googlecode.com
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
	 * Initialization state
	 * @access private
	 */
	private static $initialized = false;

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
	 * Pointcut list
	 */
	static $pointcut_list = null;
	
	/**
	 * Holds a list of association 
	 * of [className:pointcut definition]
	 * @access private
	 */
	static $pointcut_definition_list = array();
	
	/**
	 * List of classes that will
	 * bypass the 'weaving' process
	 */
	static $bypass_list = array();
	
	/**
	 * DEBUG ONLY
	 */
	static $debug = false;
	
	/**
	 * Optimization when the condition
	 * ' 1 class == 1 file ' is met.
	 * i.e. multiple class definition per file
	 * can not be reliably handled if this is 
	 * setting is set to 'true'
	 */
	static $strict = true;
	
	/*================================================================
	 					PUBLIC INTERFACE
	 ================================================================*/
	/**
	 * Constructor (borg pattern)
	 */
	public function __construct() {
	
		$this->activate();
	}
	/**
	 * Strict Mode setting
	 * @param boolean
	 */
	public function setStrict( $state = true ) {
		assert( is_bool( $state ) );
		self::$strict = $state;
	}
	/**
	 * Debug Mode setting
	 * @param boolean
	 */
	public function setDebug( $state = true ) {
		assert( is_bool( $state ) );		
		self::$debug = $state;
	}
	/**
	 * PEAR::Log setting
	 * @param PEAR::Log object OR any other object that implements a ''log'' method
	 */
	public function setLogger( &$logger ) {
		aop_factory::get( 'aop_logger' )->set( $logger, self::$debug );
	}
	/**
	 * @see aop::register_class_pointcut_definition
	 */
	public static function _register_class_pointcut_definition( $className, $filePath ) {
	
		return self::register_class_pointcut_definition( $className, $filePath );
	}
	/**
	 * Registers and associates a pointcut definition file with a specific class
	 * 
	 * @param $className string class name
	 * @param $fielPath  string absolute filesystem path to the pointcut definition file
	 */
	public static function register_class_pointcut_definition( $className, $filePath ) {
	
		self::$pointcut_definition_list[$className][] = $filePath ;
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
	 * Registers a class that will be 
	 * ignored by the weaver
	 * 
	 * @param $class string
	 */
	public function register_class_bypass( $class ) {
		self::$bypass_list[ $class ] = true;
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
	
		aop_factory::mapClass( $oClasse, $rClasse );
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
	
		if ( !isset( self::$refParams[ $key ] ))
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
	private function activate() {

		// activate just once
		if ( self::$activated )
			return;
			
		self::$activated = true;
		
		require_once 'PHP/Beautifier.php';
		require_once 'PHP/Beautifier/Batch.php';
		
		require_once "aop_exception.php";
		require_once dirname(__FILE__) . DIRECTORY_SEPARATOR ."logger". DIRECTORY_SEPARATOR. "logger.php";		
		require_once dirname(__FILE__) . DIRECTORY_SEPARATOR ."finder". DIRECTORY_SEPARATOR. "finder.php";
		require_once dirname(__FILE__) . DIRECTORY_SEPARATOR ."object". DIRECTORY_SEPARATOR. "object.php";		
		require_once dirname(__FILE__) . DIRECTORY_SEPARATOR ."object". DIRECTORY_SEPARATOR. "pool.php";		
		require_once dirname(__FILE__) . DIRECTORY_SEPARATOR ."factory". DIRECTORY_SEPARATOR. "factory.php";

		$callback = array( __CLASS__, 'our_autoload' );
		spl_autoload_register( $callback );
		
		$callback = array( __CLASS__, 'autoload' );
		spl_autoload_register( $callback );
		
	}
	/**
	 * Should only be called privately by this script
	 * The framework requires a two stage initialization process.
	 * 
	 * @access private
	 */
	public function init() {
	
		// activate just once
		if ( self::$initialized )
			return;
			
		self::$initialized = true;
	
		self::$pointcut_list = aop_factory::get( 'aop_pointcut_list' );
	}
	/**
	 * Autoloads classes making this framework
	 * @param $className string
	 */
	public static function our_autoload( $className ) {
	
		if (substr( $className, 0, 4) != 'aop_' )
			return false;
			
		$finder = aop_factory::get( 'aop_finder' );
		$path = $finder->find( $className );
		if ( is_null( $path ))
			return false;
			
		require $path;

		return ( class_exists( $className ));
	}
	/**
	 * Autoload function
	 * 
	 * @param $className the name of the class to load and process
	 * @return void
	 */
	public static function autoload( $className ) {

		aop_logger::log( __METHOD__." request for class: $className", PEAR_LOG_NOTICE );
		
		$finder = aop_factory::get( 'aop_finder' );
	
		//find the target class file
		$path = $finder->find( $className );
		if ( is_null( $path )) {
			aop_logger::log( __METHOD__." can't find source file for class $className" );
			return false;
		}

		// bypass?
		if ( isset( self::$bypass_list[ $className ])) {
			$result = include $path;
			return class_exists( $className );
		}
		
		// is the pointcut definition newer than the aspect file?
		//  don't bother if it does not exist
		$reprocess_aspect_file = false;
		$ifile = aop_factory::get( 'aop_file_source',  $path );
		$ofile = aop_factory::get( 'aop_file_aspect', $path );
		
		$def_file = aop_factory::get( 'aop_file_definition',  $path );
		if ( $def_file->exists() ) {

			$result = aop_file_comparator::compare_mtime( $def_file, $ofile );
			if ( $result == aop_file_comparator::TIMESTAMP_NEWER ) {
				// must re-process the aspect file
				$reprocess_aspect_file = true;
				aop_logger::log( __METHOD__." NEWER POINTCUT DEFINITION file found class($className)" );
			}
			
		}
		aop_object_pool::recycle( $def_file );
		
		// is the aspect file up-to-date?
		if ( $ofile->exists() && !$reprocess_aspect_file ) {
			
			aop_logger::log( __METHOD__." aspect file exist: $path" );
			
			$result = aop_file_comparator::compare_mtime( $ifile, $ofile );
			if ( $result == aop_file_comparator::TIMESTAMP_OLDER ) {
				
				aop_logger::log( __METHOD__." aspect file up-to-date" );				
				
		    	$aspect_path = $ofile->getPath();	
				$result = include $aspect_path;
				if ( !$result ) {
					throw new aop_exception( ": failed to include weaved the class file ($path)" );
				}
				
				return ( class_exists( $className ) );
			}
		}		

		// ingest any pointcut definition directly associated
		// with the required class
		self::processPointcutDefinitionList( $className );

		// is there a pointcut definition file associated with the
		// target source file?
		self::processPointcutDefinition( $path );

		// is there any point in generating an aspect representation?
		//  Use optimization if allowed to
		if ( self::$strict ) {
			// if no match is found for the required class, 
			// don't go through the lengthy weaving process
			if ( !self::$pointcut_list->findMatch( $className, '~' ) ) {
				aop_logger::log( "SKIPPING WEAVING for class($className)" );

				$result = include $path;
				if ( !$result ) {
					throw new aop_exception( ": failed to include source class file ($path)" );
				}
				
				return ( class_exists( $className ) );
			}
		}
		
		
		// process the target file
		try {
    		$result = $ifile->process();
    		
		} catch( Exception $e ) {
			throw new aop_exception( ": failed to process the class file ($path)" );				
		}
		
		// get the weaver ready
    	$weaver = aop_factory::get( 'aop_weaver' );
    	$weaver->setPointcutList( self::$pointcut_list );
    	$weaver->setInputFile( $ifile );
    	$weaver->setOutputFile( $ofile );
    	
    	// try weaving to an aspect file
    	try {
    		
    		$weaver->weave();
    		
    	} catch( Exception $e ) {
    		throw new aop_exception( ": failed to weave the class file ($path)" );
    	}

    	$aspect_path = $ofile->getPath();

    	// be nice... recycle!    	
		$weaver->recycle();    	
		$ofile->recycle();
		$ifile->recycle();
    	
		$result = include $aspect_path;
		if ( !$result ) {
			throw new aop_exception( ": failed to include weaved the class file ($path)" );
		}
		
		return ( class_exists( $className ) );
	}
	/**
	 * Processes the pointcut definition list as registered
	 * @param $className string
	 */
	private static function processPointcutDefinitionList( &$className ) {
	
		if ( !isset( self::$pointcut_definition_list[$className ] ))
			return;
			
		$liste = self::$pointcut_definition_list[$className ];
			
		foreach( $liste as $path ) {
			self::processPointcutDefinition( $path );
		}
		
	}
	/**
	 * Processes a pointcut definition contained in $path
	 * @param $path filesystem path
	 * @throws aop_exception
	 */
	private static function processPointcutDefinition( &$path ) {

		$def_file = aop_factory::get( 'aop_file_definition',  $path );
		if ( $def_file->exists() ) {
		
			// absorb the pointcut definition
			try {
				$def_file->process();
				
			} catch( Exception $e ) {
				throw new aop_exception( ": failed to process definition file ($path)" );
			}
		} else {
			aop_logger::log( __METHOD__." NO pointcut definition associated with path($path)" );
		}
		
		$def_file->recycle();
	}
	
}//end definition

//activate the framework
// =====================
$aop = new aop;
$aop->_register_class_path( get_include_path() );
$aop->_register_class_path( realpath( dirname( __FILE__ ).DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR ) );
$aop->init(); #DON'T USE THIS METHOD ANY OTHER PLACE
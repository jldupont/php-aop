<?php
/**
 * aop_token_master
 * PHP-AOP framework
 *
 * @author Jean-Lou Dupont
 * @package AOP
 * @category AOP
 * @pattern borg
 */

class aop_token_master {
	
	static $map = array(
		T_FOR					=> 'for ',
		T_FOREACH				=> 'foreach ',
		T_TRY					=> 'try ',
		T_CATCH					=> 'catch ',
	
		T_ENDWHILE				=> 'endwhile ',
		T_ENDFOREACH			=> 'endforeach ',
		T_ENDFOR				=> 'endfor ',
		T_ENDDECLARE			=> 'enddeclare ',
		T_ENDSWITCH				=> 'endswitch ',
		T_ENDIF					=> 'endif ',
		
		'(' 					=> '(',
		')' 					=> ')',
		';' 					=> ';',
		'{' 					=> '{',
		'}' 					=> '}',
		',' 					=> ',',
		'?' 					=> '?',
		':' 					=> ':',
		'=' 					=> '=',
		'<' 					=> '<',
		'>' 					=> '>',
		'.' 					=> '.',
		
		T_OBJECT_OPERATOR 		=> '->',
		
            /* INCLUDE */
		T_INCLUDE 				=> 'include ',
		T_INCLUDE_ONCE 			=> 'include_once ',
		T_REQUIRE 				=> 'require ',
		T_REQUIRE_ONCE 			=> 'require_once ',

            /* LANGUAGE CONSTRUCT */
		T_FUNCTION 				=> 'function ',
		T_PRINT 				=> 'print ',
		T_RETURN 				=> 'return ',
		T_ECHO 					=> 'echo ',
		T_NEW 					=> 'new ',
		T_CLASS 				=> 'class ',
		T_VAR 					=> 'var ',
		T_GLOBAL 				=> 'global ',
		T_THROW 				=> 'throw ',

            /* CONTROL */
		T_IF 					=> 'if ',
		T_DO 					=> 'do ',
		T_WHILE 				=> 'while ',
		T_SWITCH 				=> 'switch ',
            /* ELSE */
		T_ELSEIF 				=> 'elseif ',
		T_ELSE 					=> 'else ',
		
            /* ACCESS PHP 5 */
		T_INTERFACE 			=> 'interface ',
		T_FINAL 				=> 'final ',
		T_ABSTRACT 				=> 'abstract ',
		T_PRIVATE 				=> 'private ',
		T_PUBLIC 				=> 'public ',
		T_PROTECTED 			=> 'protected ',
		T_CONST 				=> 'const ',
		T_STATIC 				=> 'static ',
		
            /* COMPARATORS */
		T_PLUS_EQUAL 			=> '+=',
		T_MINUS_EQUAL 			=> '-=',
		T_MUL_EQUAL 			=> '*=',
		T_DIV_EQUAL 			=> '/=',
		T_CONCAT_EQUAL 			=> '.=',
		T_MOD_EQUAL 			=> '%=',
		T_AND_EQUAL 			=> '&=',
		T_OR_EQUAL 				=> '|=',
		T_XOR_EQUAL 			=> '^|',
		T_DOUBLE_ARROW 			=> '=>',
		T_SL_EQUAL 				=> '<<=',
		T_SR_EQUAL 				=> '>>=',
		T_IS_EQUAL 				=> '==',
		T_IS_NOT_EQUAL 			=> '!=',
		T_IS_IDENTICAL 			=> '===',
		T_IS_NOT_IDENTICAL 		=> '!==',
		T_IS_SMALLER_OR_EQUAL 	=> '<=',
		T_IS_GREATER_OR_EQUAL 	=> '>=',

		/* LOGICAL*/
		T_LOGICAL_OR 			=> 'or',
		T_LOGICAL_XOR 			=> 'xor',
		T_LOGICAL_AND 			=> 'and',
		T_BOOLEAN_OR 			=> '||',
		T_BOOLEAN_AND 			=> '&&',

		
		T_ARRAY					=> 'array',
		T_ARRAY_CAST			=> '(array)',
		T_AS					=> 'as',
		T_BOOL_CAST				=> '(bool)',
		T_BREAK					=> 'break',
		T_CASE					=> 'case',
		T_CLASS_C				=> '__CLASS__', 
		T_CLONE					=> 'clone', 
		T_CLOSE_TAG				=> '?>',	 
		T_CONTINUE				=> 'continue';
		T_DEC					=> '--',
		T_DECLARE				=> 'declare',
		T_DEFAULT				=> 'default',
		T_DIR					=> '__DIR__',
		T_DOLLAR_OPEN_CURLY_BRACES => '${',
		T_DOUBLE_CAST			=> '(float)',
		T_DOUBLE_COLON			=> '::',
		T_EMPTY					=> 'empty',
	);

	static $initPerformed = false;
	
	/**
	 * Constructor
	 */
	public function __construct( ) {
	
		$this->init();
	}
	
	protected function init() {
	
		if ( self::$initPerformed )
			return;
		self::$initPerformed = true;
	
		// get all the predefined tokens
		$tokens = preg_grep('/^T_/', array_keys(get_defined_constants()));
		
		// make sure we have mapping for all of those
		
	}
}//end class

__halt_compiler();

*T_ABSTRACT					abstract
*T_AND_EQUAL				&=
*T_ARRAY					array()
*T_ARRAY_CAST				(array)	type-casting
*T_AS						as	foreach

T_BAD_CHARACTER	 			anything below ASCII 32 except \t (0x09), \n (0x0a) and \r (0x0d)

*T_BOOLEAN_AND				&&	logical operators
*T_BOOLEAN_OR				||	logical operators
*T_BOOL_CAST				(bool) or (boolean)	type-casting
*T_BREAK					break	break
*T_CASE						case	switch
*T_CATCH					catch	Exceptions (available since PHP 5.0.0)

T_CHARACTER	 	 

*T_CLASS					class	classes and objects
*T_CLASS_C					__CLASS__	magic constants (available since PHP 4.3.0) 
*T_CLONE					clone	classes and objects (available since PHP 5.0.0) 
*T_CLOSE_TAG				?> or %>	 

T_COMMENT					// or #, and /* */ in PHP 5	comments

*T_CONCAT_EQUAL				.=	assignment operators
*T_CONST					const	 

T_CONSTANT_ENCAPSED_STRING	"foo" or 'bar'	string syntax

*T_CONTINUE					continue	 

T_CURLY_OPEN				???????	 	 

*T_DEC						--	incrementing/decrementing operators
*T_DECLARE					declare	declare
*T_DEFAULT					default	switch
*T_DIR						__DIR__	magic constants (available since PHP 5.3.0)
*T_DIV_EQUAL				/=	assignment operators

T_DNUMBER					0.12, etc	floating point numbers
T_DOC_COMMENT				/** */	PHPDoc style comments (available since PHP 5.0.0) 

*T_DO						do	do..while
*T_DOLLAR_OPEN_CURLY_BRACES	${	complex variable parsed syntax
*T_DOUBLE_ARROW				=>	array syntax
*T_DOUBLE_CAST				(real), (double) or (float)	type-casting
*T_DOUBLE_COLON				::	see T_PAAMAYIM_NEKUDOTAYIM below
*T_ECHO						echo	echo()
*T_ELSE						else	else
*T_ELSEIF					elseif	elseif
*T_EMPTY						empty	empty()

T_ENCAPSED_AND_WHITESPACE

*T_ENDDECLARE				enddeclare	declare, alternative syntax
*T_ENDFOR					endfor	for, alternative syntax
*T_ENDFOREACH				endforeach	foreach, alternative syntax
*T_ENDIF					endif	if, alternative syntax
*T_ENDSWITCH				endswitch	switch, alternative syntax
*T_ENDWHILE					endwhile	while, alternative syntax

T_END_HEREDOC	 			heredoc syntax
T_EVAL						eval()	eval()
T_EXIT						exit or die	exit(), die()
T_EXTENDS					extends	extends, classes and objects
T_FILE						__FILE__	magic constants

*T_FINAL						final	Final Keyword (available since PHP 5.0.0)

*T_FOR						for	for
*T_FOREACH					foreach	foreach

T_FUNCTION					function or cfunction	functions
T_FUNC_C					__FUNCTION__	magic constants (available since PHP 4.3.0) 

*T_GLOBAL					global	variable scope

T_HALT_COMPILER				__halt_compiler()	__halt_compiler (available since PHP 5.1.0)

*T_IF						if	if

T_IMPLEMENTS				implements	Object Interfaces (available since PHP 5.0.0)
T_INC						++	incrementing/decrementing operators

*T_INCLUDE					include()	include()
*T_INCLUDE_ONCE				include_once()	include_once()

T_INLINE_HTML	 	 
T_INSTANCEOF				instanceof	type operators (available since PHP 5.0.0) 
T_INT_CAST					(int) or (integer)	type-casting

*T_INTERFACE					interface	Object Interfaces (available since PHP 5.0.0)

T_ISSET						isset()	isset()

*T_IS_EQUAL					==	comparison operators
*T_IS_GREATER_OR_EQUAL		>=	comparison operators
*T_IS_IDENTICAL				===	comparison operators
*T_IS_NOT_EQUAL				!= or <>	comparison operators
*T_IS_NOT_IDENTICAL			!==	comparison operators
*T_IS_SMALLER_OR_EQUAL		<=	comparison operators

T_LINE						__LINE__	magic constants
T_LIST						list()	list()
T_LNUMBER					123, 012, 0x1ac, etc	integers

*T_LOGICAL_AND				and	logical operators
*T_LOGICAL_OR				or	logical operators
*T_LOGICAL_XOR				xor	logical operators

T_METHOD_C					__METHOD__	magic constants (available since PHP 5.0.0) 

*T_MINUS_EQUAL				-=	assignment operators

T_ML_COMMENT				/* and */	comments (PHP 4 only)

*T_MOD_EQUAL					%=	assignment operators
*T_MUL_EQUAL					*=	assignment operators

T_NS_C						__NAMESPACE__	namespaces. Also defined as T_NAMESPACE (available since PHP 5.3.0) 

*T_NEW						new	classes and objects

T_NUM_STRING	 	 
T_OBJECT_CAST				(object)	type-casting

*T_OBJECT_OPERATOR			->	classes and objects

T_OLD_FUNCTION				old_function	 
T_OPEN_TAG					<?php, <? or <%	escaping from HTML
T_OPEN_TAG_WITH_ECHO		<?= or <%=	escaping from HTML

*T_OR_EQUAL					|=	assignment operators

T_PAAMAYIM_NEKUDOTAYIM		::	::. Also defined as T_DOUBLE_COLON.
*T_PLUS_EQUAL				+=	assignment operators

*T_PRINT						print()	print()

*T_PRIVATE					private	classes and objects (available since PHP 5.0.0) 
*T_PUBLIC					public	classes and objects (available since PHP 5.0.0) 
*T_PROTECTED					protected	classes and objects (available since PHP 5.0.0) 

*T_REQUIRE					require()	require()
*T_REQUIRE_ONCE				require_once()	require_once()

*T_RETURN					return	returning values

T_SL						<<	bitwise operators
*T_SL_EQUAL					<<=	assignment operators
T_SR						>>	bitwise operators
*T_SR_EQUAL					>>=	assignment operators
T_START_HEREDOC				<<<	heredoc syntax

*T_STATIC					static	variable scope

T_STRING	 	 
T_STRING_CAST				(string)	type-casting
T_STRING_VARNAME	 	 

*T_SWITCH					switch	switch
*T_THROW						throw	Exceptions (available since PHP 5.0.0)
*T_TRY						try	Exceptions (available since PHP 5.0.0)

T_UNSET						unset()	unset()
T_UNSET_CAST				(unset)	(not documented; casts to NULL)
T_USE						use	namespaces (available since PHP 5.3.0)

*T_VAR						var	classes and objects

T_VARIABLE					$foo	variables
T_WHILE						while	while, do..while
T_WHITESPACE	 	 

*T_XOR_EQUAL					^=	assignment operators
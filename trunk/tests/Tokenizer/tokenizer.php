<?php
/*
 * @author Jean-Lou Dupont
 */

$file = dirname( __FILE__ ) . "/Test.php";

$contents = file_get_contents( $file );

$tokens = token_get_all( $contents );

#var_dump( $a );

foreach( $tokens as $token ) {

	$id      = $token[0];
	if ( is_numeric( $id ))
		$name = token_name( $id );
	else
		$name = $id;
		
	$content = $token[1];
	$line    = $token[2];

	echo "line: $line, id: $id, name: $name content: $content \n";
}

var_dump( $tokens );
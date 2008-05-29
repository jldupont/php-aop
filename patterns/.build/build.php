<?php
/**
 * Performs syntax highlighting with GeSHi
 * 
 * @author Jean-Lou Dupont
 */

require 'geshi/geshi.php';


function highlight( &$content ) {

	$geshi = new GeSHi( trim( $content, "\r\n" ), 'php' );	

	$geshi->enable_classes(); 
	$geshi->set_header_type(GESHI_HEADER_PRE); 
	$geshi->set_overall_class("code"); 
	$geshi->set_encoding("utf-8");
	$geshi->set_overall_style('background: #EEEEEE; border: padding: 0.2em'); 

	$geshi->enable_line_numbers(GESHI_FANCY_LINE_NUMBERS);
		
	$style = $geshi->get_stylesheet();
	$result = $geshi->parse_code();
		
	unset( $geshi );
		
	return array( "style" => $style, "code" => $result );        
}

function saveResult( &$file, &$result, &$baseName ) {

	$path_parts = pathinfo( $file );
	$baseName = $path_parts['basename'];

	$target = $path_parts['dirname'].'/'.$path_parts['filename'].'.html';
	
	$bytes_written = file_put_contents( $target, $result );
	
	return ( $bytes_written == strlen( $result ));
}

$srcPath = realpath( dirname( __FILE__ ).'/../' );

echo "Processing path: $srcPath \n";

$template = file_get_contents( dirname(__FILE__) . "/template.html" );

$files = glob( $srcPath."/*.php" );

foreach( $files as $file ) {

	$content = file_get_contents( $file );
	
	$result = highlight( $content );

	$page = str_replace( '%style%', $result['style'], $template );
	$page = str_replace( '%body%',  $result['code'],  $page   );
	
	$baseName = null;
	$r = saveResult( $file, $page, $baseName );
	
	echo "Result for '$baseName' is: " . ( $r ? 'success.' : 'failure.' )."\n";
}

<?php

require_once "PHP/Parser.php";

$contents = file_get_contents( dirname(__FILE__).'/test.php' );

$liste = PHP_Parser::parse( $contents );

var_dump( $liste->classes );
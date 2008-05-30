<?php
require_once ('PHP/Beautifier.php');
require_once ('PHP/Beautifier/Batch.php');

$content = file_get_contents( dirname( __FILE__ ).'/test.php' );


$oBeaut = new PHP_Beautifier();
$oBeaut->addFilterDirectory( dirname(__FILE__).'/Filter' );

$oBeaut->addFilter('ArrayNested');
$oBeaut->addFilter('Insert');

$oBeaut->setInputString( $content );
$oBeaut->process();
$oBeaut->show();

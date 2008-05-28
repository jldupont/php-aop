<?php
require_once ('PHP/Beautifier.php');
require_once ('PHP/Beautifier/Batch.php');

$content = file_get_contents( __FILE__ );


$oBeaut = new PHP_Beautifier();

$oBeaut->addFilter('ArrayNested');
$oBeaut->addFilter('ListClassFunction');

$oBeaut->setInputString( $content );
$oBeaut->process();
$oBeaut->show();

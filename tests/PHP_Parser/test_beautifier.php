<?php
require_once ('PHP/Beautifier.php');
require_once ('PHP/Beautifier/Batch.php');

$oBeaut = new PHP_Beautifier();
$oBatch = new PHP_Beautifier_Batch($oBeaut);

$oBatch->addFilter('ArrayNested');
$oBatch->addFilter('ListClassFunction');
#$oBatch->addFilter('Pear',array('add_header'=>'php'));


$oBatch->setInputFile(dirname(__FILE__).'/test.php');
$oBatch->process();
$oBatch->show();

<?php
require_once ('PHP/Beautifier.php');

$oBeaut = new PHP_Beautifier();

$oBeaut->addFilter('ArrayNested');
$oBeaut->addFilter('ListClassFunction');
W
$oBeaut->setInputFile(dirname(__FILE__).'/test.php');
$oBeaut->process();
$oBeaut->show();

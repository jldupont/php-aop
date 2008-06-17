<?php

$content = file_get_contents( dirname(__FILE__).'/TestFile.php' );

require_once ('PHP/Beautifier.php');

$oBeaut = new PHP_Beautifier();

$oBeaut->addFilter('ArrayNested');
$oBeaut->addFilter('ListClassFunction');

$oBeaut->setInputString( $content );
$oBeaut->process();
$oBeaut->show();

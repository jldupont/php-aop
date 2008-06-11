<?php

require 'aop/aop.php';
aop::register_class_path( dirname(__FILE__) );

#require_once 'Log.php';
$console = &Log::singleton('console', '', 'TEST');
$logger = &Log::singleton('composite');
$logger->addChild($console);

$logger->log("BEGIN\n");

$o1 = new TestClass;

$o1->show();

echo "\n\n----\n\n";

$o2 = new TestClass2;

$o2->show();

$logger->log("END\n");
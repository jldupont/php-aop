<?php

require 'aop/aop.php';
aop::register_class_path( dirname(__FILE__) );

$o1 = new TestClass;

$o1->show();

echo "\n\n----\n\n";

$o2 = new TestClass2;

$o2->show();

<?php

require 'aop/aop.php';
aop::register_class_path( dirname(__FILE__) );

$o = new TestClass;

$o->show();

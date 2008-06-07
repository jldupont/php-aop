<?php
class TestClass {
    public function __construct() {
        
		echo "#BEFORE\n";
	
        echo __METHOD__ . "\n";
        
		echo "#AFTER\n";
    }
    public function show() {
        
		echo "#BEFORE\n";
	
        echo __METHOD__ . "\n";
        
		echo "#AFTER\n";
    }
}
class TestClass2 {
    public function __construct() {
        echo __METHOD__ . "\n";
    }
    public function show() {
        
		echo "#BEFORE\n";
	
        echo __METHOD__ . "\n";
        
		echo "#AFTER\n";
    }
}

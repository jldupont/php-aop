<?php
class TestClass {
    public function show() {
        
		echo "#BEFORE\n";
	
        echo __METHOD__ . "\n";
        
		echo "#AFTER\n";
    }
}

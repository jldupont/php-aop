<?php
/**
 * TestPointcut test class
 *
 * @author Jean-Lou Dupont
 */
class TestPointcut {
    /**
     * Show method
     */
    public function show() {
        
		echo "#BEFORE\n";
	
        echo __METHOD__ . "\n";
        
		echo "#AFTER\n";
    }
} //endclass

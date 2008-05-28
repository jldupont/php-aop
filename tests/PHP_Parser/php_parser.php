<?php

require_once "PHP/Parser.php";

$contents = file_get_contents( dirname(__FILE__).'/test.php' );

$liste = PHP_Parser::parse( $contents );

var_dump( $liste );

// ===========================================================
						__halt_compiler();
// ===========================================================


***liste: 
object(PHP_Parser_Core)#3 (11) {
  ["lex"]=>
  object(PHP_Parser_Tokenizer)#2 (17) {
    ["debug"]=>
    bool(false)
    ["tokens"]=>
    array(123) {
      [0]=>
      array(3) {
        [0]=>
        int(367)
        [1]=>
        string(7) "<?php
"
        [2]=>
        int(1)
      }
      [1]=>
      array(3) {
        [0]=>
        int(365)
        [1]=>
        string(40) "/*
 * @author Jean-Lou Dupont
 * 
 */"
        [2]=>
        int(2)
      }
      [2]=>
      array(3) {
        [0]=>
        int(370)
        [1]=>
        string(4) "

"
        [2]=>
        int(5)
      }
      [3]=>
      array(3) {
        [0]=>
        int(352)
        [1]=>
        string(5) "class"
        [2]=>
        int(7)
      }
      [4]=>
      array(3) {
        [0]=>
        int(370)
        [1]=>
        string(1) " "
        [2]=>
        int(7)
      }
      [5]=>
      array(3) {
        [0]=>
        int(307)
        [1]=>
        string(1) "A"
        [2]=>
        int(7)
      }
      [6]=>
      array(3) {
        [0]=>
        int(370)
        [1]=>
        string(1) " "
        [2]=>
        int(7)
      }
      [7]=>
      array(2) {
        [0]=>
        int(123)
        [1]=>
        string(1) "{"
      }
      [8]=>
      array(3) {
        [0]=>
        int(370)
        [1]=>
        string(5) "

	"
        [2]=>
        int(7)
      }
      [9]=>
      array(3) {
        [0]=>
        int(346)
        [1]=>
        string(6) "static"
        [2]=>
        int(9)
      }
      [10]=>
      array(3) {
        [0]=>
        int(370)
        [1]=>
        string(1) " "
        [2]=>
        int(9)
      }
      [11]=>
      array(3) {
        [0]=>
        int(309)
        [1]=>
        string(11) "$testString"
        [2]=>
        int(9)
      }
      [12]=>
      array(3) {
        [0]=>
        int(370)
        [1]=>
        string(1) " "
        [2]=>
        int(9)
      }
      [13]=>
      array(2) {
        [0]=>
        int(61)
        [1]=>
        string(1) "="
      }
      [14]=>
      array(3) {
        [0]=>
        int(370)
        [1]=>
        string(1) " "
        [2]=>
        int(9)
      }
      [15]=>
      array(3) {
        [0]=>
        int(315)
        [1]=>
        string(7) ""Hello""
        [2]=>
        int(9)
      }
      [16]=>
      array(2) {
        [0]=>
        int(59)
        [1]=>
        string(1) ";"
      }
      [17]=>
      array(3) {
        [0]=>
        int(370)
        [1]=>
        string(6) "
	
	"
        [2]=>
        int(9)
      }
      [18]=>
      array(3) {
        [0]=>
        int(366)
        [1]=>
        string(33) "/**
	 * testAnnoyingString
	 */"
        [2]=>
        int(11)
      }
      [19]=>
      array(3) {
        [0]=>
        int(370)
        [1]=>
        string(3) "
	"
        [2]=>
        int(13)
      }
      [20]=>
      array(3) {
        [0]=>
        int(341)
        [1]=>
        string(6) "public"
        [2]=>
        int(14)
      }
      [21]=>
      array(3) {
        [0]=>
        int(370)
        [1]=>
        string(1) " "
        [2]=>
        int(14)
      }
      [22]=>
      array(3) {
        [0]=>
        int(333)
        [1]=>
        string(8) "function"
        [2]=>
        int(14)
      }
      [23]=>
      array(3) {
        [0]=>
        int(370)
        [1]=>
        string(1) " "
        [2]=>
        int(14)
      }
      [24]=>
      array(3) {
        [0]=>
        int(307)
        [1]=>
        string(18) "testAnnoyingString"
        [2]=>
        int(14)
      }
      [25]=>
      array(2) {
        [0]=>
        int(40)
        [1]=>
        string(1) "("
      }
      [26]=>
      array(2) {
        [0]=>
        int(41)
        [1]=>
        string(1) ")"
      }
      [27]=>
      array(3) {
        [0]=>
        int(370)
        [1]=>
        string(1) " "
        [2]=>
        int(14)
      }
      [28]=>
      array(2) {
        [0]=>
        int(123)
        [1]=>
        string(1) "{"
      }
      [29]=>
      array(3) {
        [0]=>
        int(370)
        [1]=>
        string(4) "
		"
        [2]=>
        int(14)
      }
      [30]=>
      array(3) {
        [0]=>
        int(335)
        [1]=>
        string(6) "return"
        [2]=>
        int(15)
      }
      [31]=>
      array(3) {
        [0]=>
        int(370)
        [1]=>
        string(1) " "
        [2]=>
        int(15)
      }
      [32]=>
      array(3) {
        [0]=>
        int(307)
        [1]=>
        string(4) "self"
        [2]=>
        int(15)
      }
      [33]=>
      array(3) {
        [0]=>
        int(375)
        [1]=>
        string(2) "::"
        [2]=>
        int(15)
      }
      [34]=>
      array(3) {
        [0]=>
        int(309)
        [1]=>
        string(11) "$testString"
        [2]=>
        int(15)
      }
      [35]=>
      array(2) {
        [0]=>
        int(123)
        [1]=>
        string(1) "{"
      }
      [36]=>
      array(3) {
        [0]=>
        int(370)
        [1]=>
        string(1) " "
        [2]=>
        int(15)
      }
      [37]=>
      array(3) {
        [0]=>
        int(305)
        [1]=>
        string(1) "0"
        [2]=>
        int(15)
      }
      [38]=>
      array(3) {
        [0]=>
        int(370)
        [1]=>
        string(1) " "
        [2]=>
        int(15)
      }
      [39]=>
      array(2) {
        [0]=>
        int(125)
        [1]=>
        string(1) "}"
      }
      [40]=>
      array(3) {
        [0]=>
        int(370)
        [1]=>
        string(1) " "
        [2]=>
        int(15)
      }
      [41]=>
      array(3) {
        [0]=>
        int(283)
        [1]=>
        string(2) "=="
        [2]=>
        int(15)
      }
      [42]=>
      array(3) {
        [0]=>
        int(370)
        [1]=>
        string(1) " "
        [2]=>
        int(15)
      }
      [43]=>
      array(3) {
        [0]=>
        int(315)
        [1]=>
        string(3) ""H""
        [2]=>
        int(15)
      }
      [44]=>
      array(2) {
        [0]=>
        int(59)
        [1]=>
        string(1) ";"
      }
      [45]=>
      array(3) {
        [0]=>
        int(370)
        [1]=>
        string(3) "
	"
        [2]=>
        int(15)
      }
      [46]=>
      array(2) {
        [0]=>
        int(125)
        [1]=>
        string(1) "}"
      }
      [47]=>
      array(3) {
        [0]=>
        int(370)
        [1]=>
        string(4) "

"
        [2]=>
        int(16)
      }
      [48]=>
      array(2) {
        [0]=>
        int(125)
        [1]=>
        string(1) "}"
      }
      [49]=>
      array(3) {
        [0]=>
        int(370)
        [1]=>
        string(6) "


"
        [2]=>
        int(18)
      }
      [50]=>
      array(3) {
        [0]=>
        int(352)
        [1]=>
        string(5) "class"
        [2]=>
        int(21)
      }
      [51]=>
      array(3) {
        [0]=>
        int(370)
        [1]=>
        string(1) " "
        [2]=>
        int(21)
      }
      [52]=>
      array(3) {
        [0]=>
        int(307)
        [1]=>
        string(1) "B"
        [2]=>
        int(21)
      }
      [53]=>
      array(3) {
        [0]=>
        int(370)
        [1]=>
        string(4) " 
	"
        [2]=>
        int(21)
      }
      [54]=>
      array(3) {
        [0]=>
        int(354)
        [1]=>
        string(7) "extends"
        [2]=>
        int(22)
      }
      [55]=>
      array(3) {
        [0]=>
        int(370)
        [1]=>
        string(1) " "
        [2]=>
        int(22)
      }
      [56]=>
      array(3) {
        [0]=>
        int(307)
        [1]=>
        string(1) "A"
        [2]=>
        int(22)
      }
      [57]=>
      array(3) {
        [0]=>
        int(370)
        [1]=>
        string(1) " "
        [2]=>
        int(22)
      }
      [58]=>
      array(2) {
        [0]=>
        int(123)
        [1]=>
        string(1) "{"
      }
      [59]=>
      array(3) {
        [0]=>
        int(370)
        [1]=>
        string(5) "

	"
        [2]=>
        int(22)
      }
      [60]=>
      array(3) {
        [0]=>
        int(347)
        [1]=>
        string(3) "var"
        [2]=>
        int(24)
      }
      [61]=>
      array(3) {
        [0]=>
        int(370)
        [1]=>
        string(1) " "
        [2]=>
        int(24)
      }
      [62]=>
      array(3) {
        [0]=>
        int(309)
        [1]=>
        string(3) "$v1"
        [2]=>
        int(24)
      }
      [63]=>
      array(3) {
        [0]=>
        int(370)
        [1]=>
        string(1) " "
        [2]=>
        int(24)
      }
      [64]=>
      array(2) {
        [0]=>
        int(61)
        [1]=>
        string(1) "="
      }
      [65]=>
      array(3) {
        [0]=>
        int(370)
        [1]=>
        string(1) " "
        [2]=>
        int(24)
      }
      [66]=>
      array(3) {
        [0]=>
        int(307)
        [1]=>
        string(4) "null"
        [2]=>
        int(24)
      }
      [67]=>
      array(2) {
        [0]=>
        int(59)
        [1]=>
        string(1) ";"
      }
      [68]=>
      array(3) {
        [0]=>
        int(370)
        [1]=>
        string(3) "
	"
        [2]=>
        int(24)
      }
      [69]=>
      array(3) {
        [0]=>
        int(347)
        [1]=>
        string(3) "var"
        [2]=>
        int(25)
      }
      [70]=>
      array(3) {
        [0]=>
        int(370)
        [1]=>
        string(1) " "
        [2]=>
        int(25)
      }
      [71]=>
      array(3) {
        [0]=>
        int(309)
        [1]=>
        string(3) "$v2"
        [2]=>
        int(25)
      }
      [72]=>
      array(3) {
        [0]=>
        int(370)
        [1]=>
        string(1) " "
        [2]=>
        int(25)
      }
      [73]=>
      array(2) {
        [0]=>
        int(61)
        [1]=>
        string(1) "="
      }
      [74]=>
      array(3) {
        [0]=>
        int(370)
        [1]=>
        string(6) " 
			"
        [2]=>
        int(25)
      }
      [75]=>
      array(3) {
        [0]=>
        int(307)
        [1]=>
        string(4) "null"
        [2]=>
        int(26)
      }
      [76]=>
      array(2) {
        [0]=>
        int(59)
        [1]=>
        string(1) ";"
      }
      [77]=>
      array(3) {
        [0]=>
        int(370)
        [1]=>
        string(6) "
	
	"
        [2]=>
        int(26)
      }
      [78]=>
      array(3) {
        [0]=>
        int(366)
        [1]=>
        string(36) "/**
	 * @before CLASS::METHOD
	 */"
        [2]=>
        int(28)
      }
      [79]=>
      array(3) {
        [0]=>
        int(370)
        [1]=>
        string(3) "
	"
        [2]=>
        int(30)
      }
      [80]=>
      array(3) {
        [0]=>
        int(341)
        [1]=>
        string(6) "public"
        [2]=>
        int(31)
      }
      [81]=>
      array(3) {
        [0]=>
        int(370)
        [1]=>
        string(1) " "
        [2]=>
        int(31)
      }
      [82]=>
      array(3) {
        [0]=>
        int(333)
        [1]=>
        string(8) "function"
        [2]=>
        int(31)
      }
      [83]=>
      array(3) {
        [0]=>
        int(370)
        [1]=>
        string(1) " "
        [2]=>
        int(31)
      }
      [84]=>
      array(3) {
        [0]=>
        int(307)
        [1]=>
        string(11) "__construct"
        [2]=>
        int(31)
      }
      [85]=>
      array(2) {
        [0]=>
        int(40)
        [1]=>
        string(1) "("
      }
      [86]=>
      array(2) {
        [0]=>
        int(41)
        [1]=>
        string(1) ")"
      }
      [87]=>
      array(3) {
        [0]=>
        int(370)
        [1]=>
        string(1) " "
        [2]=>
        int(31)
      }
      [88]=>
      array(2) {
        [0]=>
        int(123)
        [1]=>
        string(1) "{"
      }
      [89]=>
      array(3) {
        [0]=>
        int(370)
        [1]=>
        string(6) "
	
	"
        [2]=>
        int(31)
      }
      [90]=>
      array(2) {
        [0]=>
        int(125)
        [1]=>
        string(1) "}"
      }
      [91]=>
      array(3) {
        [0]=>
        int(370)
        [1]=>
        string(5) "

	"
        [2]=>
        int(33)
      }
      [92]=>
      array(3) {
        [0]=>
        int(347)
        [1]=>
        string(3) "var"
        [2]=>
        int(35)
      }
      [93]=>
      array(3) {
        [0]=>
        int(370)
        [1]=>
        string(1) " "
        [2]=>
        int(35)
      }
      [94]=>
      array(3) {
        [0]=>
        int(309)
        [1]=>
        string(3) "$v3"
        [2]=>
        int(35)
      }
      [95]=>
      array(3) {
        [0]=>
        int(370)
        [1]=>
        string(1) " "
        [2]=>
        int(35)
      }
      [96]=>
      array(2) {
        [0]=>
        int(61)
        [1]=>
        string(1) "="
      }
      [97]=>
      array(3) {
        [0]=>
        int(370)
        [1]=>
        string(7) " 
				"
        [2]=>
        int(35)
      }
      [98]=>
      array(3) {
        [0]=>
        int(307)
        [1]=>
        string(4) "null"
        [2]=>
        int(36)
      }
      [99]=>
      array(2) {
        [0]=>
        int(59)
        [1]=>
        string(1) ";"
      }
      [100]=>
      array(3) {
        [0]=>
        int(370)
        [1]=>
        string(5) "

	"
        [2]=>
        int(36)
      }
      [101]=>
      array(3) {
        [0]=>
        int(341)
        [1]=>
        string(6) "public"
        [2]=>
        int(38)
      }
      [102]=>
      array(3) {
        [0]=>
        int(370)
        [1]=>
        string(1) " "
        [2]=>
        int(38)
      }
      [103]=>
      array(3) {
        [0]=>
        int(333)
        [1]=>
        string(8) "function"
        [2]=>
        int(38)
      }
      [104]=>
      array(3) {
        [0]=>
        int(370)
        [1]=>
        string(1) " "
        [2]=>
        int(38)
      }
      [105]=>
      array(3) {
        [0]=>
        int(307)
        [1]=>
        string(14) "methodToUpdate"
        [2]=>
        int(38)
      }
      [106]=>
      array(2) {
        [0]=>
        int(40)
        [1]=>
        string(1) "("
      }
      [107]=>
      array(2) {
        [0]=>
        int(41)
        [1]=>
        string(1) ")"
      }
      [108]=>
      array(3) {
        [0]=>
        int(370)
        [1]=>
        string(1) " "
        [2]=>
        int(38)
      }
      [109]=>
      array(2) {
        [0]=>
        int(123)
        [1]=>
        string(1) "{"
      }
      [110]=>
      array(3) {
        [0]=>
        int(370)
        [1]=>
        string(7) "
	
		"
        [2]=>
        int(38)
      }
      [111]=>
      array(3) {
        [0]=>
        int(307)
        [1]=>
        string(8) "var_dump"
        [2]=>
        int(40)
      }
      [112]=>
      array(2) {
        [0]=>
        int(40)
        [1]=>
        string(1) "("
      }
      [113]=>
      array(3) {
        [0]=>
        int(370)
        [1]=>
        string(7) " 
				"
        [2]=>
        int(40)
      }
      [114]=>
      array(3) {
        [0]=>
        int(309)
        [1]=>
        string(5) "$this"
        [2]=>
        int(41)
      }
      [115]=>
      array(3) {
        [0]=>
        int(370)
        [1]=>
        string(5) " 
		"
        [2]=>
        int(41)
      }
      [116]=>
      array(2) {
        [0]=>
        int(41)
        [1]=>
        string(1) ")"
      }
      [117]=>
      array(2) {
        [0]=>
        int(59)
        [1]=>
        string(1) ";"
      }
      [118]=>
      array(3) {
        [0]=>
        int(370)
        [1]=>
        string(7) "
		
	"
        [2]=>
        int(42)
      }
      [119]=>
      array(2) {
        [0]=>
        int(125)
        [1]=>
        string(1) "}"
      }
      [120]=>
      array(3) {
        [0]=>
        int(370)
        [1]=>
        string(8) "
				
"
        [2]=>
        int(44)
      }
      [121]=>
      array(2) {
        [0]=>
        int(125)
        [1]=>
        string(1) "}"
      }
      [122]=>
      array(3) {
        [0]=>
        int(370)
        [1]=>
        string(2) "
"
        [2]=>
        int(46)
      }
    }
    ["N"]=>
    int(123)
    ["line"]=>
    int(47)
    ["pos"]=>
    int(123)
    ["token"]=>
    int(78)
    ["value"]=>
    string(1) "}"
    ["valueWithWhitespace"]=>
    string(9) "
				
}"
    ["lastCommentToken"]=>
    int(-1)
    ["lastCommentLine"]=>
    int(-1)
    ["lastComment"]=>
    string(0) ""
    ["lastParsedComment"]=>
    bool(false)
    ["_globalSearch"]=>
    bool(false)
    ["_options"]=>
    NULL
    ["_whitespace:private"]=>
    string(2) "
"
    ["_trackingWhitespace:private"]=>
    int(0)
    ["_docParser:private"]=>
    array(0) {
    }
  }
  ["functions"]=>
  array(0) {
  }
  ["classes"]=>
  array(2) {
    ["A"]=>
    array(1) {
      [0]=>
      array(11) {
        ["type"]=>
        string(5) "class"
        ["startline"]=>
        int(7)
        ["endline"]=>
        int(21)
        ["modifiers"]=>
        array(0) {
        }
        ["name"]=>
        string(1) "A"
        ["extends"]=>
        array(0) {
        }
        ["implements"]=>
        array(0) {
        }
        ["info"]=>
        array(2) {
          [0]=>
          array(8) {
            ["type"]=>
            string(3) "var"
            ["name"]=>
            string(11) "$testString"
            ["line"]=>
            int(9)
            ["default"]=>
            string(7) ""Hello""
            ["modifiers"]=>
            array(1) {
              [0]=>
              string(6) "static"
            }
            ["doc"]=>
            NULL
            ["parseddoc"]=>
            NULL
            ["docline"]=>
            NULL
          }
          [1]=>
          array(10) {
            ["type"]=>
            string(6) "method"
            ["name"]=>
            string(18) "testAnnoyingString"
            ["startline"]=>
            int(14)
            ["endline"]=>
            int(18)
            ["parameters"]=>
            array(0) {
            }
            ["modifiers"]=>
            array(1) {
              [0]=>
              string(6) "public"
            }
            ["info"]=>
            array(1) {
              [0]=>
              array(1) {
                ["usedclass"]=>
                string(4) "self"
              }
            }
            ["doc"]=>
            NULL
            ["parseddoc"]=>
            NULL
            ["docline"]=>
            NULL
          }
        }
        ["doc"]=>
        string(33) "/**
	 * testAnnoyingString
	 */"
        ["parseddoc"]=>
        bool(false)
        ["docline"]=>
        int(11)
      }
    }
    ["B"]=>
    array(1) {
      [0]=>
      array(11) {
        ["type"]=>
        string(5) "class"
        ["startline"]=>
        int(21)
        ["endline"]=>
        int(47)
        ["modifiers"]=>
        array(0) {
        }
        ["name"]=>
        string(1) "B"
        ["extends"]=>
        array(1) {
          [0]=>
          string(1) "A"
        }
        ["implements"]=>
        array(0) {
        }
        ["info"]=>
        array(5) {
          [0]=>
          array(8) {
            ["type"]=>
            string(3) "var"
            ["name"]=>
            string(3) "$v1"
            ["line"]=>
            int(24)
            ["default"]=>
            string(4) "null"
            ["modifiers"]=>
            array(1) {
              [0]=>
              string(6) "public"
            }
            ["doc"]=>
            string(0) ""
            ["parseddoc"]=>
            bool(false)
            ["docline"]=>
            int(-1)
          }
          [1]=>
          array(8) {
            ["type"]=>
            string(3) "var"
            ["name"]=>
            string(3) "$v2"
            ["line"]=>
            int(25)
            ["default"]=>
            string(4) "null"
            ["modifiers"]=>
            array(1) {
              [0]=>
              string(6) "public"
            }
            ["doc"]=>
            string(0) ""
            ["parseddoc"]=>
            bool(false)
            ["docline"]=>
            int(-1)
          }
          [2]=>
          array(10) {
            ["type"]=>
            string(6) "method"
            ["name"]=>
            string(11) "__construct"
            ["startline"]=>
            int(31)
            ["endline"]=>
            int(35)
            ["parameters"]=>
            array(0) {
            }
            ["modifiers"]=>
            array(1) {
              [0]=>
              string(6) "public"
            }
            ["info"]=>
            array(0) {
            }
            ["doc"]=>
            NULL
            ["parseddoc"]=>
            NULL
            ["docline"]=>
            NULL
          }
          [3]=>
          array(8) {
            ["type"]=>
            string(3) "var"
            ["name"]=>
            string(3) "$v3"
            ["line"]=>
            int(35)
            ["default"]=>
            string(4) "null"
            ["modifiers"]=>
            array(1) {
              [0]=>
              string(6) "public"
            }
            ["doc"]=>
            string(36) "/**
	 * @before CLASS::METHOD
	 */"
            ["parseddoc"]=>
            bool(false)
            ["docline"]=>
            int(28)
          }
          [4]=>
          array(10) {
            ["type"]=>
            string(6) "method"
            ["name"]=>
            string(14) "methodToUpdate"
            ["startline"]=>
            int(38)
            ["endline"]=>
            int(46)
            ["parameters"]=>
            array(0) {
            }
            ["modifiers"]=>
            array(1) {
              [0]=>
              string(6) "public"
            }
            ["info"]=>
            array(0) {
            }
            ["doc"]=>
            NULL
            ["parseddoc"]=>
            NULL
            ["docline"]=>
            NULL
          }
        }
        ["doc"]=>
        string(0) ""
        ["parseddoc"]=>
        bool(false)
        ["docline"]=>
        int(-1)
      }
    }
  }
  ["interfaces"]=>
  array(0) {
  }
  ["includes"]=>
  array(0) {
  }
  ["globals"]=>
  array(0) {
  }
  ["data"]=>
  array(2) {
    [0]=>
    array(11) {
      ["type"]=>
      string(5) "class"
      ["startline"]=>
      int(7)
      ["endline"]=>
      int(21)
      ["modifiers"]=>
      array(0) {
      }
      ["name"]=>
      string(1) "A"
      ["extends"]=>
      array(0) {
      }
      ["implements"]=>
      array(0) {
      }
      ["info"]=>
      array(2) {
        [0]=>
        array(8) {
          ["type"]=>
          string(3) "var"
          ["name"]=>
          string(11) "$testString"
          ["line"]=>
          int(9)
          ["default"]=>
          string(7) ""Hello""
          ["modifiers"]=>
          array(1) {
            [0]=>
            string(6) "static"
          }
          ["doc"]=>
          NULL
          ["parseddoc"]=>
          NULL
          ["docline"]=>
          NULL
        }
        [1]=>
        array(10) {
          ["type"]=>
          string(6) "method"
          ["name"]=>
          string(18) "testAnnoyingString"
          ["startline"]=>
          int(14)
          ["endline"]=>
          int(18)
          ["parameters"]=>
          array(0) {
          }
          ["modifiers"]=>
          array(1) {
            [0]=>
            string(6) "public"
          }
          ["info"]=>
          array(1) {
            [0]=>
            array(1) {
              ["usedclass"]=>
              string(4) "self"
            }
          }
          ["doc"]=>
          NULL
          ["parseddoc"]=>
          NULL
          ["docline"]=>
          NULL
        }
      }
      ["doc"]=>
      string(33) "/**
	 * testAnnoyingString
	 */"
      ["parseddoc"]=>
      bool(false)
      ["docline"]=>
      int(11)
    }
    [1]=>
    array(11) {
      ["type"]=>
      string(5) "class"
      ["startline"]=>
      int(21)
      ["endline"]=>
      int(47)
      ["modifiers"]=>
      array(0) {
      }
      ["name"]=>
      string(1) "B"
      ["extends"]=>
      array(1) {
        [0]=>
        string(1) "A"
      }
      ["implements"]=>
      array(0) {
      }
      ["info"]=>
      array(5) {
        [0]=>
        array(8) {
          ["type"]=>
          string(3) "var"
          ["name"]=>
          string(3) "$v1"
          ["line"]=>
          int(24)
          ["default"]=>
          string(4) "null"
          ["modifiers"]=>
          array(1) {
            [0]=>
            string(6) "public"
          }
          ["doc"]=>
          string(0) ""
          ["parseddoc"]=>
          bool(false)
          ["docline"]=>
          int(-1)
        }
        [1]=>
        array(8) {
          ["type"]=>
          string(3) "var"
          ["name"]=>
          string(3) "$v2"
          ["line"]=>
          int(25)
          ["default"]=>
          string(4) "null"
          ["modifiers"]=>
          array(1) {
            [0]=>
            string(6) "public"
          }
          ["doc"]=>
          string(0) ""
          ["parseddoc"]=>
          bool(false)
          ["docline"]=>
          int(-1)
        }
        [2]=>
        array(10) {
          ["type"]=>
          string(6) "method"
          ["name"]=>
          string(11) "__construct"
          ["startline"]=>
          int(31)
          ["endline"]=>
          int(35)
          ["parameters"]=>
          array(0) {
          }
          ["modifiers"]=>
          array(1) {
            [0]=>
            string(6) "public"
          }
          ["info"]=>
          array(0) {
          }
          ["doc"]=>
          NULL
          ["parseddoc"]=>
          NULL
          ["docline"]=>
          NULL
        }
        [3]=>
        array(8) {
          ["type"]=>
          string(3) "var"
          ["name"]=>
          string(3) "$v3"
          ["line"]=>
          int(35)
          ["default"]=>
          string(4) "null"
          ["modifiers"]=>
          array(1) {
            [0]=>
            string(6) "public"
          }
          ["doc"]=>
          string(36) "/**
	 * @before CLASS::METHOD
	 */"
          ["parseddoc"]=>
          bool(false)
          ["docline"]=>
          int(28)
        }
        [4]=>
        array(10) {
          ["type"]=>
          string(6) "method"
          ["name"]=>
          string(14) "methodToUpdate"
          ["startline"]=>
          int(38)
          ["endline"]=>
          int(46)
          ["parameters"]=>
          array(0) {
          }
          ["modifiers"]=>
          array(1) {
            [0]=>
            string(6) "public"
          }
          ["info"]=>
          array(0) {
          }
          ["doc"]=>
          NULL
          ["parseddoc"]=>
          NULL
          ["docline"]=>
          NULL
        }
      }
      ["doc"]=>
      string(0) ""
      ["parseddoc"]=>
      bool(false)
      ["docline"]=>
      int(-1)
    }
  }
  ["yyidx"]=>
  int(-1)
  ["yyerrcnt"]=>
  int(-67)
  ["yystack"]=>
  array(0) {
  }
  ["_retvalue:private"]=>
  NULL
}
***classes: 
array(2) {
  ["A"]=>
  array(1) {
    [0]=>
    array(11) {
      ["type"]=>
      string(5) "class"
      ["startline"]=>
      int(7)
      ["endline"]=>
      int(21)
      ["modifiers"]=>
      array(0) {
      }
      ["name"]=>
      string(1) "A"
      ["extends"]=>
      array(0) {
      }
      ["implements"]=>
      array(0) {
      }
      ["info"]=>
      array(2) {
        [0]=>
        array(8) {
          ["type"]=>
          string(3) "var"
          ["name"]=>
          string(11) "$testString"
          ["line"]=>
          int(9)
          ["default"]=>
          string(7) ""Hello""
          ["modifiers"]=>
          array(1) {
            [0]=>
            string(6) "static"
          }
          ["doc"]=>
          NULL
          ["parseddoc"]=>
          NULL
          ["docline"]=>
          NULL
        }
        [1]=>
        array(10) {
          ["type"]=>
          string(6) "method"
          ["name"]=>
          string(18) "testAnnoyingString"
          ["startline"]=>
          int(14)
          ["endline"]=>
          int(18)
          ["parameters"]=>
          array(0) {
          }
          ["modifiers"]=>
          array(1) {
            [0]=>
            string(6) "public"
          }
          ["info"]=>
          array(1) {
            [0]=>
            array(1) {
              ["usedclass"]=>
              string(4) "self"
            }
          }
          ["doc"]=>
          NULL
          ["parseddoc"]=>
          NULL
          ["docline"]=>
          NULL
        }
      }
      ["doc"]=>
      string(33) "/**
	 * testAnnoyingString
	 */"
      ["parseddoc"]=>
      bool(false)
      ["docline"]=>
      int(11)
    }
  }
  ["B"]=>
  array(1) {
    [0]=>
    array(11) {
      ["type"]=>
      string(5) "class"
      ["startline"]=>
      int(21)
      ["endline"]=>
      int(47)
      ["modifiers"]=>
      array(0) {
      }
      ["name"]=>
      string(1) "B"
      ["extends"]=>
      array(1) {
        [0]=>
        string(1) "A"
      }
      ["implements"]=>
      array(0) {
      }
      ["info"]=>
      array(5) {
        [0]=>
        array(8) {
          ["type"]=>
          string(3) "var"
          ["name"]=>
          string(3) "$v1"
          ["line"]=>
          int(24)
          ["default"]=>
          string(4) "null"
          ["modifiers"]=>
          array(1) {
            [0]=>
            string(6) "public"
          }
          ["doc"]=>
          string(0) ""
          ["parseddoc"]=>
          bool(false)
          ["docline"]=>
          int(-1)
        }
        [1]=>
        array(8) {
          ["type"]=>
          string(3) "var"
          ["name"]=>
          string(3) "$v2"
          ["line"]=>
          int(25)
          ["default"]=>
          string(4) "null"
          ["modifiers"]=>
          array(1) {
            [0]=>
            string(6) "public"
          }
          ["doc"]=>
          string(0) ""
          ["parseddoc"]=>
          bool(false)
          ["docline"]=>
          int(-1)
        }
        [2]=>
        array(10) {
          ["type"]=>
          string(6) "method"
          ["name"]=>
          string(11) "__construct"
          ["startline"]=>
          int(31)
          ["endline"]=>
          int(35)
          ["parameters"]=>
          array(0) {
          }
          ["modifiers"]=>
          array(1) {
            [0]=>
            string(6) "public"
          }
          ["info"]=>
          array(0) {
          }
          ["doc"]=>
          NULL
          ["parseddoc"]=>
          NULL
          ["docline"]=>
          NULL
        }
        [3]=>
        array(8) {
          ["type"]=>
          string(3) "var"
          ["name"]=>
          string(3) "$v3"
          ["line"]=>
          int(35)
          ["default"]=>
          string(4) "null"
          ["modifiers"]=>
          array(1) {
            [0]=>
            string(6) "public"
          }
          ["doc"]=>
          string(36) "/**
	 * @before CLASS::METHOD
	 */"
          ["parseddoc"]=>
          bool(false)
          ["docline"]=>
          int(28)
        }
        [4]=>
        array(10) {
          ["type"]=>
          string(6) "method"
          ["name"]=>
          string(14) "methodToUpdate"
          ["startline"]=>
          int(38)
          ["endline"]=>
          int(46)
          ["parameters"]=>
          array(0) {
          }
          ["modifiers"]=>
          array(1) {
            [0]=>
            string(6) "public"
          }
          ["info"]=>
          array(0) {
          }
          ["doc"]=>
          NULL
          ["parseddoc"]=>
          NULL
          ["docline"]=>
          NULL
        }
      }
      ["doc"]=>
      string(0) ""
      ["parseddoc"]=>
      bool(false)
      ["docline"]=>
      int(-1)
    }
  }
}

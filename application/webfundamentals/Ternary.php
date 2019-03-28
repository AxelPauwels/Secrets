<?php

// --------------------------------
//      Spaceship
//      Switch
// ->   Ternary
//      Null Coalesce
//      Alternate Syntax (for Control Structures)
// --------------------------------

/*

(expression) ? result1 : result2
(condition) ? true : false

The expression ------ (expression) ? result1 : result2 ----- evaluates to result1 
if expression evaluates to TRUE, and result2 if expression evaluates to FALSE. 

*/

$authors = ["Charles Dickens", "Jane Austin", "William Shakespeare", "Mark Twain", "Louisa May Alcott"];
$count = count($authors);


$outcome = ($count > 0) ? "Author Total: ".$count : "No Authors.";
echo $outcome;
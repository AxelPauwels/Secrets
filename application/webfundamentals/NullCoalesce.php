<?php

// --------------------------------
//      Spaceship
//      Switch
//      Ternary
// ->   Null Coalesce
//      Alternate Syntax (for Control Structures)
// --------------------------------

/*

$a ?? "Default Value"

The idea is that if the first value is null then it will take the second value. If that value is null it will take the next value.

*/

$authors = ["Charles Dickens", "Jane Austin", "William Shakespeare", "Mark Twain", "Louisa May Alcott"];
$count = count($authors);

//$outcome = $count ? $count : "Count unvailable."; // reduce this syntax
$outcome = $count ?? "Count unvailable.";
echo $outcome . PHP_EOL;

$outcome = $count2 ?? "Count unvailable.";
echo $outcome . PHP_EOL;

$outcome = $count2 ?? $count ?? "Count unvailable."; // you can chain this.
                                                      // if count2 is not set, use count, if count is not set, use the string
echo $outcome . PHP_EOL;

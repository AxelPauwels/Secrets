<?php

// --------------------------------
// ->   Spaceship
//      Switch
//      Ternary
//      Null Coalesce
//      Alternate Syntax (for Control Structures)
// --------------------------------

/*

This lumps all the <, ==, >  operations together.

This would be best used with a switch statement. 

*/

echo PHP_EOL;
echo 1 <=> 2; // -1 ~ left side is less than right side
echo PHP_EOL;
echo 2 <=> 2; // 0 ~ both sides are equal to each other
echo PHP_EOL;
echo 2 <=> 1; // 1 ~ left side is greater than right side
echo PHP_EOL;

////////////////////////////////////////////////////////////////////////////////////////////////

$check1 = 1 <=> 2;
$check2 = 2 <=> 2;
$check3 = 2 <=> 1;
echo PHP_EOL;
echo $check1;
echo PHP_EOL;
echo $check2;
echo PHP_EOL;
echo $check3;
echo PHP_EOL;

////////////////////////////////////////////////////////////////////////////////////////////////

$check4 = (1 === 1);
$check5 = (2 <=> 1);
$check6 = true;
$check7 = true;
$check8 = false;
$superCheck1 = ($check4 && $check5);
$superCheck2 = ($check6 && $check7);
$superCheck3 = ($check6 || $check7);
echo PHP_EOL;
echo $superCheck1;
echo PHP_EOL;
echo $superCheck2;
echo PHP_EOL;
echo $superCheck3;
echo PHP_EOL;

////////////////////////////////////////////////////////////////////////////////////////////////




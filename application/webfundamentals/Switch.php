<?php

// --------------------------------
//      Spaceship
// ->   Switch
//      Ternary
//      Null Coalesce
//      Alternate Syntax (for Control Structures)
// --------------------------------

/*

Expression is only evaluated once and the result is compared to each case statements. If it's a match, then the code code is executed up until the break;

- case statement can be empty
- if no break statement is used, then the next block of code is executed.

*/

$authors = ["Charles Dickens", "Jane Austin", "William Shakespeare", "Mark Twain", "Louisa May Alcott"];
$authors = [];
$count = count($authors);

switch($count)
{
    case 0:
        echo "There are no authors.".PHP_EOL;;
        break;
    case 1:
        echo "There is 1 author.".PHP_EOL;;
        break;
    default:
        echo "There is a total of ".$count." authors.".PHP_EOL;;
        break;    
} 


//-- String example
$authorName = "Charles Dickens";

switch ($authorName) 
{
    case "William Shakespeare":
    case "Jane Austin":
        echo "Not the Author";
        break;
    case "Charles Dickens":
        echo "Found him!";
        break;
    default:
        echo "Author Not Found";
}

//-- Spaceship operator example (must have PHP 7 installed for it to work)
switch (5 <=> 7)
{
    case 1:
        echo "Greater Than";
        break;
    case 0:
        echo "Equal";
        break;
    case -1:
        echo "Less Than";
        break;
}


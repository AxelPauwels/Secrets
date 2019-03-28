<?php

// --------------------------------
// -- include and include_once
// --------------------------------

/*

Includes a file into the current script. Ideal for including classes into your applications.

Include_once makes sure that the file is only included once. Even if it is included again in another file.

*/



//include_once 'Person.php';
//include_once 'Author.php';

include_once __DIR__ . '/Person.php';
include_once __DIR__ . '/Author.php';

echo  get_include_path().PHP_EOL;
echo  get_include_path().PHP_EOL;
echo  get_include_path().PHP_EOL;

$newAuthor = new Author();
//$newAuthor = new Author("Samuel Langhorne", "Clemens", 1899);
//echo $newAuthor->getCompleteName();
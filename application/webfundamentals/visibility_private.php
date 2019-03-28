<?php

// --------------------------------
//      1 - Inheritance
//      2 - Visibility_protected
// ->   3 - Visibility_private
//      4 - Static
// --------------------------------
/*

With a protected property, you can only access that method INSIDE the class.
You can access them from class to class, but not through the object variable.

*/

class Person3
{
    const AVG_LIFE_SPAN = 79;

    protected $firstName;
    protected $lastName;
    protected $yearBorn;

    function __construct($tempFirst = "", $tempLast = "", $tempYear = "")
    {
        $this->firstName = $tempFirst;
        $this->lastName = $tempLast;
        $this->yearBorn = $tempYear;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function setFirstName($tempName)
    {
        $this->firstName = $tempName;
    }

    protected function getFullName()
    {
        return $this->firstName." ".$this->lastName.PHP_EOL;
    }
}

class Author3 extends Person3
{
    protected $penName = "Mark Twain";

    public function getPenName()
    {
        return $this->penName.PHP_EOL;
    }

    public function getCompleteName()
    {
        return $this->firstName." ".$this->lastName." a.k.a. ".$this->penName.PHP_EOL;
    }
}

$newAuthor = new Author3("Samuel Langhorne", "Clemens", 1899);
//echo $newAuthor->penName;
//echo $newAuthor->getFullName();
echo $newAuthor->getCompleteName();

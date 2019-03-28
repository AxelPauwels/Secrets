<?php

// --------------------------------
//      1 - Inheritance
// ->   2 - Visibility_protected
//      3 - Visibility_private
//      4 - Static
// --------------------------------

/*

With a private property/method, you can only access that method inside the class that initiated it.
You can't access them from class to class nor can you access them from the object variable.

*/

class Person2
{
    const AVG_LIFE_SPAN = 79;

    private $firstName;
    private $lastName;
    private $yearBorn;

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
        return $this->firstName . " " . $this->lastName . PHP_EOL;
    }
}

class Author2 extends Person2
{
    private $penName = "Mark Twain";

    public function getPenName()
    {
        return $this->penName . PHP_EOL;
    }

    public function getCompleteName()
    {
        // return $this->firstName." ".$this->lastName." a.k.a. ".$this->penName.PHP_EOL;
        // kan niet aan de variabelen (firstName & lastName) van Person,
        // deze zijn private en kunnen enkel opgeroepen worden in de class waar ze zijn gedeclareerd
        return $this->getFullName() . " a.k.a. " . $this->penName . PHP_EOL; // kan niet aan de variabelen van Person
    }
}

$newAuthor = new Author2("Samuel Langhorne", "Clemens", 1899);
//echo $newAuthor->penName;
echo $newAuthor->getCompleteName();
<?php

// --------------------------------
// ->   1 - Inheritance
//      2 - Visibility
//      3 - Visibility_private
//      4 - Static
// --------------------------------

/*

Inheritance allows one class to inherit the methods and properties of another class,
meaning you have access to them through the object variable of the child class.

*/

class Person1
{
    const AVG_LIFE_SPAN = 79;
    // const
    // needs a value
    // only accesable inside the person class
    // Static methods and properties can be accessed via the :: double colon and the class name.
    // No need for the class to declared to an object variable.

    public $firstName;
    public $lastName;
    public $yearBorn;

    function __construct($tempFirst = "", $tempLast = "", $tempYear = "")
    {
        echo "Person __construct()".PHP_EOL;
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

    public function getFullName()
    {
        echo "Person->getFullName()".PHP_EOL;
        return $this->firstName." ".$this->lastName.PHP_EOL;
    }
}

class Author1 extends Person1
{
    public $penName = "Mark Twain";

    public function getPenName()
    {
        return $this->penName.PHP_EOL;
    }

    //-- Modified to include what the Author wrote
    public function getFullName()
    {
        echo "Author->getFullName()".PHP_EOL;
        return $this->firstName." ".$this->lastName.PHP_EOL;
    }
}

$newAuthor = new Author1("Samuel Langhorne", "Clemens", 1899);
echo $newAuthor->getFullName();

// inheriting inherits all teh properties and methods of that class
// there is no constructor in Author, so its uses the parents constructor
// if there is a child-method with the same name like a parent-method, this child-method will overwrite the parent-method
<?php

// --------------------------------
//      1 - Inheritance
//      2 - Visibility_protected
//      3 - Visibility_private
// ->   4 - Static
// --------------------------------

/*
Static methods and properties allow the variable to be accessed without the need of the class object.

Static methods must be self contained, meaning they can't rely on the $this-> to grab data from other places.
Think of it as a stand alone function call that happens to reside inside the class.
But can rely on other static methods or properties
*/

/*
Static methods and properties can be accessed via the :: double colon and the class name. No need for the class to declared to an object variable.
*/

class Person4
{
    const AVG_LIFE_SPAN = 79;

    private $firstName;
    private $lastName;
    private $yearBorn;

    public static $parentStaticProperty = "Hell yeah";


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

class Author4 extends Person4
{
    public static $centuryPopular = "19th";
    private $penName = "Mark Twain";

    public function getPenName()
    {
        return $this->penName.PHP_EOL;
    }

    public function getCompleteName()
    {
        return $this->getFullName()." a.k.a. ".$this->penName.PHP_EOL; // kan niet aan de variabelen van Person
    }

    public static function getCenturyAuthorWasPopular()
    {
        return self::$centuryPopular.PHP_EOL; // pseudo variable "self::" instead of "this->"
        // use "parent::" to access a static property from the parent
    }

    public static function getParentStaticProperty()
    {
        return parent::$parentStaticProperty.PHP_EOL;
    }
}

echo Author4::$centuryPopular.PHP_EOL;
echo Author4::getCenturyAuthorWasPopular();
echo Author4::getParentStaticProperty();
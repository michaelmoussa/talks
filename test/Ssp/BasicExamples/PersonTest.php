<?php

namespace Ssp\BasicExamples;

class PersonTest extends \PHPUnit_Framework_TestCase
{
    public function testFullNameConsistsOfFirstAndLastName()
    {
        // Adding the required $middleInitial argument to the constructor breaks this test.
        $person = new Person('Michael', 'Moussa');
        $this->assertSame('Michael Moussa', $person->getFullName());
    }

    public function testFullNameIncludesMiddleInitial()
    {
        $person = new Person('Michael', 'Moussa', 'P');
        $this->assertSame('Michael P. Moussa', $person->getFullName());
    }
}

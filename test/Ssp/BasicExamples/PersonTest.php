<?php

namespace Ssp\BasicExamples;

class PersonTest extends \PHPUnit_Framework_TestCase
{
    public function testFullNameConsistsOfFirstAndLastName()
    {
        $person = new Person('Michael', 'Moussa');

        // The $middleInitial is optional now, but the test fails because the output is wrong.
        $this->assertSame('Michael Moussa', $person->getFullName());
    }

    public function testFullNameIncludesMiddleInitial()
    {
        $person = new Person('Michael', 'Moussa', 'P');
        $this->assertSame('Michael P. Moussa', $person->getFullName());
    }
}

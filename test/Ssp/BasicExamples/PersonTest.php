<?php

namespace Ssp\BasicExamples;

class PersonTest extends \PHPUnit_Framework_TestCase
{
    public function testFullNameConsistsOfFirstAndLastName()
    {
        // The test passes now because we've made a special case in the method for names with no middle initial.
        $person = new Person('Michael', 'Moussa');
        $this->assertSame('Michael Moussa', $person->getFullName());
    }

    public function testFullNameIncludesMiddleInitial()
    {
        $person = new Person('Michael', 'Moussa', 'P');
        $this->assertSame('Michael P. Moussa', $person->getFullName());
    }
}

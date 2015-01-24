<?php

namespace Ssp\BasicExamples;

class PersonTest extends \PHPUnit_Framework_TestCase
{
    public function testFullNameConsistsOfFirstAndLastName()
    {
        $person = new Person('Michael', 'Moussa');
        $this->assertSame('Michael Moussa', $person->getFullName());
    }
}

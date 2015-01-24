<?php

namespace Ssp\BasicExamples;

/**
 * Just a "sandbox" for playing with the various assertions!
 */
class AssertionSandboxTest extends \PHPUnit_Framework_TestCase
{
    public function testPlayingWithManyAssertions()
    {
        /*
         * Typically, an assertion will look like this:
         *
         * $this->assert<Something>($expected, $actual, $message);
         *     $expected: What the value *should* be.
         *     $actual: What the value *actually* is.
         *     $message: Text to display if the assertion fails.
         */
        $this->assertEquals(4, (2 + 2), 'Uh oh! Someone forgot how to add.');

        /*
         * The $message is optional. If excluded, a sane default is used.
         * In this case: "Failed asserting that an array contains $needle."
         */
        $this->assertContains(2, [1, 2, 3]);

        // For most "assert<Something>", there's also an "assertNot<Something>"
        $this->assertNotContains(4, [1, 2, 3]);

        /*
         * You can test "Equality" or "Identity" ("==" vs. "===")
         *
         * So, integer 123 is equal to string '123', but they're not *the same*.
         */
        $this->assertSame(123, 123);
        $this->assertNotSame(123, '123');

        // Sometimes, you don't need the $expected either.
        $this->assertTrue(true);
        $this->assertEmpty(null);
        $this->assertFileExists(__FILE__);

        /*
         * Using variables in your assertions can help make your tests less brittle.
         *
         * If you need to change your test data, you need only do it in one place,
         * rather than looking through your test to change it everywhere.
         */
        $person = new Person('Michael', 'Moussa');
        $this->assertSame('Michael Moussa', $person->getFullName());
        // vs
        $firstName = 'Michael';
        $lastName = 'Moussa';
        $person = new Person($firstName, $lastName);
        $this->assertSame($firstName . ' ' . $lastName, $person->getFullName());

        /*
         * You can "get away" with only ever using a single assertion (assertTrue), but using
         * all of them makes your tests more expressive, easier to read, and easier to debug.
         */
        $string = 'foobar';
        $suffix = 'bar';
        $this->assertTrue(substr($string, 0 - strlen($suffix)) === $suffix);
        // vs
        $this->assertStringEndsWith($suffix, $string);

        /*
         * There are MANY more assertions. Check them out!
         * http://phpunit.de/manual/current/en/appendixes.assertions.html
         */
    }
}

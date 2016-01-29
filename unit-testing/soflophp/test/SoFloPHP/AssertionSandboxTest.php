<?php

class AssertionSandboxTest extends PHPUnit_Framework_TestCase
{
    public function testAssertionExamples()
    {
        $this->assertTrue(true);
        $this->assertContains(2, [1, 2, 3]);
        $this->assertArrayNotHasKey('foo', ['bar' => 1, 'baz' => 2]);
        $this->assertEmpty(null);
        $this->assertTag(['id' => 'foobar'], '<div id="foobar"></div>');
        $this->assertSame(123, 123);
        $this->assertEquals(4, (2 + 2), 'Hey look, you can have custom error messages too!');

        // ... and many more! http://phpunit.de/manual/current/en/appendixes.assertions.html
    }
}

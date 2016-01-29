<?php

class MockingSandboxTest extends PHPUnit_Framework_TestCase
{
    public function testMockingExample()
    {
        $this->markTestSkipped('Skipping beyond this tag because it breaks code coverage');

        $mock = $this->getMockBuilder('SoFloPHP\BankAccount')
            ->getMock();

        $mock->deposit(100);
        $this->assertSame(
            100,
            $mock->getBalance(),
            '"->deposit(...)" is a mocked method and doesn\'t actually do anything!'
        );
    }
}

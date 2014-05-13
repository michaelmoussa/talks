<?php

class MockingSandboxTest extends PHPUnit_Framework_TestCase
{
    public function testMockingExample()
    {
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

<?php

namespace Ssp\TipsAndTricks;

use Mockery as m;

class MockingPdoTest extends \PHPUnit_Framework_TestCase
{
    public function testOneWouldProbablyTryThisFirstButItWillFail()
    {
        $this->markTestSkipped('<--- Comment out this line to watch this test fail gloriously!');

        /*
         * You can't mock PDO instances the same way you'd mock other classes.
         *
         * PHPUnit_Framework_MockObject_RuntimeException: You cannot serialize or unserialize PDO instances
         */
        $pdo = $this->getMockBuilder('PDO')
                    ->disableOriginalConstructor()
                    ->getMock();
        $someService = new SomeService($pdo);
    }

    public function testMockPdoWithPhpunitUsingStub()
    {
        $pdo = $this->getMockBuilder('Ssp\TipsAndTricks\PdoTestHelper')
                    // We *can't* disable the original constructor here, hence the need for the stub in our helper
                    ->getMock();
        $someService = new SomeService($pdo);
    }

    public function testOrJustUseMockery()
    {
        // Mockery accounts for this inconvenience by default, so just mock PDO like you'd mock anything else.
        $pdo = m::mock('PDO');
        $someService = new SomeService($pdo);
    }
}

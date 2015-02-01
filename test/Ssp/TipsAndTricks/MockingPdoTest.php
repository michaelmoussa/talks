<?php

namespace Ssp\TipsAndTricks;

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
}

<?php

namespace Ssp\TipsAndTricks;

class MockingFunctionsHelperTest extends \PHPUnit_Framework_TestCase
{
    public function testMockingPHPFunctions()
    {
        /*
         * This test fails because the return value of microtime() is constantly changing.
         *
         * Without mocking this in some way, you won't be able to make any time-related
         * assertions against your system under test if it uses microtime().
         */
        $helper = new MockingFunctionsHelper();
        $this->assertSame(microtime(), $helper->whatMicrotimeTimeIsIt());
    }
}

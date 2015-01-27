<?php

namespace Ssp\TipsAndTricks;

class MockingFunctionsHelperTest extends \PHPUnit_Framework_TestCase
{
    public function testMockingPHPFunctions()
    {
        /*
         * Now it will work, since we've overridden the microtime() function
         * under this namespace to return a constant value.
         */
        $helper = new MockingFunctionsHelper();
        $this->assertSame(12345, $helper->whatMicrotimeTimeIsIt());
    }
}

function microtime($getAsFloat = false)
{
    return 12345;
}

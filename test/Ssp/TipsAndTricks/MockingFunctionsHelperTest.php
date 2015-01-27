<?php

namespace Ssp\TipsAndTricks;

class MockingFunctionsHelperTest extends \PHPUnit_Framework_TestCase
{
    public function testMockingPHPFunctions()
    {
        // Or, we can use the fancy UOPZ extension!

        uopz_backup('microtime'); // backup "microtime" before we override it, so we don't affect other tests

        /*
         * Replace "microtime" to return a simple constant
         */
        uopz_function('microtime', function () {
            return 12345;
        });

        // Run the test
        $helper = new MockingFunctionsHelper();
        $this->assertSame(12345, $helper->whatMicrotimeTimeIsIt());

        // Restore the original "microtime" function
        uopz_restore('microtime');

        /*
         * Read more about UOPZ at the links below:
         *
         * http://php.net/manual/en/ref.uopz.php
         * http://blog.krakjoe.ninja/2015/01/mocking-php.html
         */
    }
}

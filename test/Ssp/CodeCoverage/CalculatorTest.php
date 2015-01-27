<?php

namespace Ssp\CodeCoverage;

class CalculatorTest extends \PHPUnit_Framework_TestCase
{
    public function testCanDivideTwoNumbers()
    {
        $calculator = new Calculator();
        $this->assertSame(2.5, $calculator->divide(5, 2));
    }

    public function testCanBreakTheDivideFunctionBecauseForgotToAccountForDividingByZero()
    {
        $this->markTestSkipped('<--- Comment out this line to watch this test fail gloriously!');

        $calculator = new Calculator();

        // Yes, we have "100%" test coverage, but that doesn't mean we've tested everything!
        $calculator->divide(5, 0);
    }
}

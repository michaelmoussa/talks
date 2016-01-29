<?php

namespace Ssp\CodeCoverage;

class CalculatorTest extends \PHPUnit_Framework_TestCase
{
    public function testCanDivideTwoNumbers()
    {
        $calculator = new Calculator();
        $this->assertSame(2.5, $calculator->divide(5, 2));
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Cannot divide by zero!
     */
    public function testThrowsInvalidArgumentExceptionIfTryingToDivideByZero()
    {
        $calculator = new Calculator();
        $calculator->divide(5, 0);
    }
}

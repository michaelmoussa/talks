<?php

namespace Ssp\CodeCoverage;

class CalculatorTest extends \PHPUnit_Framework_TestCase
{
    public function testCanDivideTwoNumbers()
    {
        $calculator = new Calculator();
        $this->assertSame(2.5, $calculator->divide(5, 2));
    }
}

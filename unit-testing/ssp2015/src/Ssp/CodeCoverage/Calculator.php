<?php

namespace Ssp\CodeCoverage;

class Calculator
{
    public function divide($numerator, $denominator)
    {
        if ($denominator == 0) {
            throw new \InvalidArgumentException('Cannot divide by zero!');
        }
        return $numerator / $denominator;
    }
}

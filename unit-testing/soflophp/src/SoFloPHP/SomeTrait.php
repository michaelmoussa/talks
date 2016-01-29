<?php

namespace SoFloPHP;

trait SomeTrait
{
    public $foo = 'bar';

    public function whatTimeIsIt()
    {
        return microtime();
    }

    public function getRandomNumber($min, $max)
    {
        return rand($min, $max);
    }
}

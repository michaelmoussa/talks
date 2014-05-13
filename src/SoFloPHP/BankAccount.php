<?php

namespace SoFloPHP;

class BankAccount
{
    protected $balance;

    public function __construct($balance = 0)
    {
        $this->balance = $balance;
    }
}

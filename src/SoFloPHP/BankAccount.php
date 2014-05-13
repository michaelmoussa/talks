<?php

namespace SoFloPHP;

class BankAccount
{
    protected $balance;

    public function __construct($balance = 0)
    {
        $this->balance = $balance;
    }

    public function getBalance()
    {
        return $this->balance;
    }

    public function deposit($amount)
    {
        if ($amount < 0) {
            throw new \InvalidArgumentException('Deposit amount cannot be negative!');
        }

        $this->balance += $amount;
    }

    public function withdraw($amount)
    {
        if ($amount < 0) {
            throw new \InvalidArgumentException('Withdrawal amount cannot be negative!');
        }

        $this->balance -= $amount;
    }
}

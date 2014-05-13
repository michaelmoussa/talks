<?php

namespace SoFloPHP;

use PHPUnit_Framework_TestCase;

class BankAccountTest extends PHPUnit_Framework_TestCase
{
    public function testBankAccountBalanceIsInitiallyZero()
    {
        $account = new BankAccount();
        $this->assertSame(0, $account->getBalance());
    }
}

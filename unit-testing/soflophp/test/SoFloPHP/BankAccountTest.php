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

    public function testAccountBalanceCanBeSetViaConstructor()
    {
        $account = new BankAccount(100);
        $this->assertSame(100, $account->getBalance());
    }

    public function testDepositingMoneyIncreasesTheBalanceByTheAmountDeposited()
    {
        $account = new BankAccount();
        $account->deposit(100);
        $this->assertSame(100, $account->getBalance());
    }

    public function testWithdrawingMoneyDecreasesTheBalanceByTheAmountWithdrawn()
    {
        $account = new BankAccount(100);
        $account->withdraw(100);
        $this->assertSame(0, $account->getBalance());
    }

    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Deposit amount cannot be negative!
     */
    public function testExceptionIsThrownWhenDepositingNegativeMoney()
    {
        $account = new BankAccount();
        $account->deposit(-100);
    }

    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Withdrawal amount cannot be negative!
     */
    public function testExceptionIsThrownWhenWithdrawingNegativeMoney()
    {
        $account = new BankAccount();
        $account->withdraw(-100);
    }
}

<?php

namespace SoFloPHP;

use PHPUnit_Framework_TestCase;

class BankAccountServiceTest extends PHPUnit_Framework_TestCase
{
    public function testPersistInsertsNewAccountsIntoTheDatabase()
    {
        $service = new BankAccountService(new \PDO('mysql:dbname=soflophp;host=127.0.0.1', 'root'));

        $account = new BankAccount();
        $account->deposit(500);
        $newAccountId = $service->persist($account);

        $dbAccount = $service->findByAccountId($newAccountId);
        $this->assertEquals($newAccountId, $dbAccount->getId());
        $this->assertEquals(500, $dbAccount->getBalance());
    }

    public function testPersistInsertsNewAccountsIntoTheDatabaseMockedVersion()
    {
        $stmt = $this->getMockBuilder('stdClass')
            ->setMethods(['execute'])
            ->getMock();
        $stmt->expects($this->once())
            ->method('execute')
            ->with([500]);

        $pdo = $this->getMockBuilder('PDO')
            ->setConstructorArgs(['sqlite::memory:'])
            ->getMock();
        $pdo->expects($this->once())
            ->method('prepare')
            ->with('insert into account (balance) values (?)')
            ->will($this->returnValue($stmt));
        $pdo->expects($this->once())
            ->method('lastInsertId')
            ->will($this->returnValue(1));
        $service = new BankAccountService($pdo);

        $account = new BankAccount();
        $account->deposit(500);
        $newAccountId = $service->persist($account);
        $this->assertEquals(1, $newAccountId);
    }
}

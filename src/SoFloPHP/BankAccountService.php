<?php

namespace SoFloPHP;

use PDO;

class BankAccountService
{
    protected $database;

    public function __construct(PDO $database)
    {
        $this->database = $database;
    }

    public function persist(BankAccount $account)
    {
        if ($account->getId()) {
            $stmt = $this->database->prepare('update account set balance = ? where id = ?');
            $stmt->execute([$account->getBalance(), $account->getId()]);
        } else {
            $stmt = $this->database->prepare('insert into account (balance) values (?)');
            $stmt->execute([$account->getBalance()]);
        }
    }
}

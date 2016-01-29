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

    /**
     * Searches for an account by the provided ID.
     *
     * @param int $accountId
     * @return BankAccount
     */
    public function findByAccountId($accountId)
    {
        $stmt = $this->database->prepare('select * from account where id = ?');
        $stmt->execute([$accountId]);

        if ($stmt->rowCount() === 0) {
            return null;
        }

        $row = $stmt->fetch();
        $account = new BankAccount($row['balance']);
        $account->setId($row['id']);
        return $account;
    }

    /**
     * Persists the provided account.
     *
     * @param BankAccount $account
     * @return int The account ID
     */
    public function persist(BankAccount $account)
    {
        if ($account->getId()) {
            $stmt = $this->database->prepare('update account set balance = ? where id = ?');
            $stmt->execute([$account->getBalance(), $account->getId()]);
            return $account->getId();
        } else {
            $stmt = $this->database->prepare('insert into account (balance) values (?)');
            $stmt->execute([$account->getBalance()]);
            return $this->database->lastInsertId();
        }
    }
}

<?php

namespace SoFloPHP;

require '../vendor/autoload.php';

/**
 * CREATE TABLE account (id INT NOT NULL PRIMARY KEY AUTO_INCREMENT, balance INT NOT NULL DEFAULT 0);
 */
$service = new BankAccountService(new \PDO('mysql:dbname=soflophp;host=127.0.0.1', 'root'));

$account = new BankAccount();
$account->deposit(500);
$service->persist($account);

/**
 * mysql> select * from account;
 * +----+---------+
 * | id | balance |
 * +----+---------+
 * |  1 |     500 |
 * +----+---------+
 * 1 row in set (0.00 sec)
 */

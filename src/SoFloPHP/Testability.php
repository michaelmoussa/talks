<?php

namespace SoFloPHP;

use PDO;

class Testability
{
    /**
     * @var BankAccountService
     */
    protected $bankAccountService;

    /**
     * BAD - constructor creates its own PDO and BankAccountService instance, which makes it impossible to mock
     * either of them.
     */
    public function __construct_1()
    {
        $pdo = new PDO('mysql:host=localhost;dbname=test', 'username', 'password');
        $this->bankAccountService = new BankAccountService($pdo);
    }

    /**
     * BETTER - constructor receives the PDO instance as a dependency, so we can mock it, but we still don't
     * have direct access to the BankAccountService
     */
    public function __construct_2(PDO $pdo)
    {
        $this->bankAccountService = new BankAccountService($pdo);
    }

    /**
     * BEST - we only needed the PDO instance to create the BankAccountService, so why not just ask for the
     * BankAccountService itself? Now we can mock whatever we need to.
     *
     * @param BankAccountService $bankAccountService
     */
    public function __construct_3(BankAccountService $bankAccountService)
    {
        $this->bankAccountService = $bankAccountService;
    }

    /**
     * OK TOO, BUT NOT MY FIRST CHOICE - use a setter to inject the BankAccountService. Avoids a long list of
     * constructor arguments (then again, if your constructor requires a long list of arguments, then maybe your
     * class is doing way too much and could benefit from some refactoring)
     *
     * @param BankAccountService $bankAccountService
     */
    public function setBankAccountService(BankAccountService $bankAccountService)
    {
        $this->bankAccountService = $bankAccountService;
    }
}

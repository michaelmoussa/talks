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

    /**
     * With $data as a global variable, its value could have been set *anywhere* in the application. Is $data an array?
     * Does each element of $data have an element with the key "name"? If we run into an application error, how can we
     * trace back to find where the value was set incorrectly? If we have no way to know the state of the variable when
     * the live application is being run, how can our tests give us any confidence?
     */
    public function processTheData()
    {
        global $data;

        foreach ($data as &$value) {
            $value['nameInReverse'] = strrev($value['name']);
        }
    }

    /**
     * Basically the same as the above example, except we can be confident about what the value of our $data variable
     * will be when the application runs - it'll be whatever it was set to when we invoked this function, because we
     * know that it can't be modified from anywhere else in the program. Any runtime errors will lead us backwards
     * straight to where the problem originates.
     */
    public function processTheDataBetter($data)
    {
        foreach ($data as &$value) {
            $value['nameInReverse'] = strrev($value['name']);
        }

        return $data;
    }

    /**
     * "PATH_TO_QUOTE_OF_THE_DAY" could be a global constant containing the path to a file. Its value is predictable,
     * and nothing can change it randomly from anywhere in the application.
     */
    public function getQuoteOfTheDay()
    {
        return file_get_contents(PATH_TO_QUOTE_OF_THE_DAY);
    }

    /**
     * We don't want to actually make a request to /some-url every time we run our tests, but how can we mock out that
     * call to ::get(...) to prevent that from happening? We can't. Avoid static method calls.
     *
     * Possible exception: Maybe you have some kind of ArrayUtils or StringUtils class with static methods - as long
     * as those methods do things you *know* you'll never need to mock, then using them is fine, as there is no sense
     * to be passing an instance of a utils class around everywhere.
     */
    public function makeExpensiveApiCall()
    {
        return Http::get('/some-url');
    }

    /**
     * Basically the same as the issue with static method calls, but deserves special mention because it's such a
     * commonly used anti-pattern.
     */
    public function getUsers()
    {
        $database = Database::getInstance();
        return $database->query('select * from users');
    }
}

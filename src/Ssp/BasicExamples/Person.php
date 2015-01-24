<?php

namespace Ssp\BasicExamples;

class Person
{
    /**
     * @var string
     */
    protected $firstName;

    /**
     * @var string
     */
    protected $lastName;

    /**
     * @var string
     */
    protected $middleInitial;

    /**
     * Constructor
     *
     * @param string $firstName
     * @param string $lastName
     * @param string $middleInitial
     */
    public function __construct($firstName, $lastName, $middleInitial = '')
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->middleInitial = $middleInitial;
    }

    /**
     * Returns the first name, middle initial, and last name separated by spaces.
     *
     * @return string
     */
    public function getFullName()
    {
        return $this->firstName . ' ' . $this->middleInitial . '. ' . $this->lastName;
    }
}

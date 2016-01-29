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
     * If there is no middle initial, it returns just the first and last name.
     *
     * @return string
     */
    public function getFullName()
    {
        if (empty($this->middleInitial)) {
            return $this->firstName . ' ' . $this->lastName;
        } else {
            return $this->firstName . ' ' . $this->middleInitial . '. ' . $this->lastName;
        }
    }
}

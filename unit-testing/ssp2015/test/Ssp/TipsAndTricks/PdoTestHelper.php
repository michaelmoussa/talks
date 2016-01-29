<?php

namespace Ssp\TipsAndTricks;

/**
 * Class that extends PDO, which we can mock instead of PDO in order to test our services that depend
 * on a PDO instance.
 */
class PdoTestHelper extends \PDO
{
    /**
     * Just an empty constructor to prevent the default PDO constructor from being called
     */
    public function __construct()
    {
    }
}

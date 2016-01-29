<?php

namespace Ssp\TipsAndTricks;

use PDO;

/**
 * Any ol' service that has PDO as a dependency.
 */
class SomeService
{
    /**
     * @param PDO $pdo
     */
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }
}

<?php

declare(strict_types=1);

namespace tests;

use PDO;

class TestingFactory
{
    public static function createDbConnection(): PDO
    {
        return new PDO(
            'mysql:host=localhost;port=3306;dbname=solid',
            'solid',
            'local'
        );
    }
}

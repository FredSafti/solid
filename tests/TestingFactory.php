<?php

declare(strict_types=1);

namespace tests;

use PDO;

class TestingFactory
{
    public static function createDbConnection(): PDO
    {
        $exists = is_file('var/db.sqlite');

        $db = new PDO('sqlite:var/db.sqlite', null, null, [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);

        if (! $exists) {
            self::loadFixtures($db);
        }

        return $db;
    }

    private static function loadFixtures(PDO $db): void
    {
        $db->query('CREATE TABLE users (
            id TINYINT NOT NULL,
            login TINTYTEXT NOT NULL,
            fullname TINYTEXT NOT NULL
        )');

        $db->query('CREATE TABLE imported (
            field1 TINYTEXT NOT NULL,
            field2 TINTYTEXT NOT NULL,
            field3 TINYTEXT NOT NULL
        )');
    }
}

<?php

declare(strict_types=1);

namespace tests;

use PDO;
use PHPUnit\Framework\TestCase;
use solid\DataImporter;
use solid\Loader\CsvLoader;
use solid\Repository\ImportedRepository;
use solid\Repository\UserRepository;

class DataImporterTest extends TestCase
{
    public function testImport()
    {
        $db = new PDO(
            'mysql:host=localhost;port=3306;dbname=solid',
            'solid',
            'local'
        );

        $loader = new CsvLoader();
        $repository = new ImportedRepository($db);

        $importer = new DataImporter($loader, $repository);
        $importer->import('var/import/data.csv');

        $stmt = $db->prepare('SELECT COUNT(*) AS nb FROM imported');
        $stmt->execute();
        $res = $stmt->fetch();

        $this->assertEquals(3, $res['nb']);
    }

    public function testUsers()
    {
        $db = new PDO(
            'mysql:host=localhost;port=3306;dbname=solid',
            'solid',
            'local'
        );

        $loader = new CsvLoader();
        $repository = new UserRepository($db);

        $importer = new DataImporter($loader, $repository);
        $importer->import('var/import/users.csv');

        $stmt = $db->prepare('SELECT COUNT(*) AS nb FROM users');
        $stmt->execute();
        $res = $stmt->fetch();

        $this->assertEquals(3, $res['nb']);
    }
}

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
        $db = TestingFactory::createDbConnection();

        $loader = new CsvLoader();
        $repository = new ImportedRepository($db);

        $importer = new DataImporter($loader, $repository);
        $importer->import('var/import/data.csv');

        $this->assertSame(3, $repository->getCount());
    }

    public function testUsers()
    {
        $db = TestingFactory::createDbConnection();

        $loader = new CsvLoader();
        $repository = new UserRepository($db);

        $importer = new DataImporter($loader, $repository);
        $importer->import('var/import/users.csv');

        $this->assertSame(3, $repository->getCount());
    }
}

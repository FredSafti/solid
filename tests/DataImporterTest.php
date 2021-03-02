<?php

declare(strict_types=1);

namespace tests;

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

        $loader = new CsvLoader('var/import/data.csv');
        $repository = new ImportedRepository($db);

        $importer = new DataImporter($loader, $repository);
        $importer->import();

        $this->assertSame(3, $repository->getCount());
    }

    public function testUsers()
    {
        $db = TestingFactory::createDbConnection();

        $loader = new CsvLoader('var/import/users.csv');
        $repository = new UserRepository($db);

        $importer = new DataImporter($loader, $repository);
        $importer->import();

        $this->assertSame(3, $repository->getCount());
    }
}

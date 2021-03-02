<?php

declare(strict_types=1);

namespace tests;

use PHPUnit\Framework\TestCase;
use solid\CsvDataImporter;
use solid\Loader;
use solid\Repository;

class CsvDataImporterTest extends TestCase
{
    public function testImport()
    {
        $db = TestingFactory::createDbConnection();

        $loader = new Loader();
        $repository = new Repository($db);

        $importer = new CsvDataImporter($loader, $repository);
        $importer->import('var/import/data.csv');

        $this->assertSame(3, $repository->getCount());
    }
}

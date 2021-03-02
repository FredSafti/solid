<?php

declare(strict_types=1);

namespace tests;

use PHPUnit\Framework\TestCase;
use solid\CsvDataImporter;

class CsvDataImporterTest extends TestCase
{
    public function testImport()
    {
        $importer = new CsvDataImporter();
        $importer->import('var/import/data.csv');
    }
}

<?php

declare(strict_types=1);

namespace tests;

use PDO;
use PHPUnit\Framework\TestCase;
use solid\CsvDataImporter;
use solid\Loader;
use solid\Repository;

class CsvDataImporterTest extends TestCase
{
    public function testImport()
    {
        $db = new PDO(
            'mysql:host=localhost;port=3306;dbname=solid',
            'solid',
            'local'
        );

        $loader = new Loader();
        $repository = new Repository($db);

        $importer = new CsvDataImporter($loader, $repository);
        $importer->import('var/import/data.csv');

        $stmt = $db->prepare('SELECT COUNT(*) AS nb FROM imported');
        $stmt->execute();
        $res = $stmt->fetch();

        $this->assertEquals(3, $res['nb']);
    }
}

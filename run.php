<?php

use solid\DataImporter;
use solid\Loader\CsvLoader;
use solid\Repository\ImportedRepository;

require 'vendor/autoload.php';

$db = new PDO(
    'mysql:host=localhost;port=3306;dbname=solid',
    'solid',
    'local'
);

$loader = new CsvLoader();
$repository = new ImportedRepository($db);

$importer = new DataImporter($loader, $repository);
$importer->import('var/import/data.csv');

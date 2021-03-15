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

$loader = new Loader('var/import/data.csv');
$repository = new Repository($db);

$importer = new CsvDataImporter($loader, $repository);
$importer->import();

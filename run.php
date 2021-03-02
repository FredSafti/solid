<?php

use solid\CsvDataImporter;
use solid\Loader;
use solid\Repository;

require 'vendor/autoload.php';

$db = new PDO(
    'mysql:host=localhost;port=3306;dbname=solid',
    'solid',
    'local'
);

$loader = new Loader();
$repository = new Repository($db);

$importer = new CsvDataImporter($loader, $repository);
$importer->import('var/import/data.csv');

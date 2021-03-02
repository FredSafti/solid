<?php

use solid\CsvDataImporter;
use solid\Loader;

require 'vendor/autoload.php';

$db = new PDO(
    'mysql:host=localhost;port=3306;dbname=solid',
    'solid',
    'local'
);

$loader = new Loader();

$importer = new CsvDataImporter($loader, $db);
$importer->import('var/import/data.csv');

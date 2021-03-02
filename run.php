<?php

use solid\CsvDataImporter;

require 'vendor/autoload.php';

$db = new PDO(
    'mysql:host=localhost;port=3306;dbname=solid',
    'solid',
    'local'
);

$importer = new CsvDataImporter($db);
$importer->import('var/import/data.csv');

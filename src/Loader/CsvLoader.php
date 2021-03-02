<?php

declare(strict_types=1);

namespace solid\Loader;

class CsvLoader extends FileLoader
{
    public function load(string $filename): array
    {
        $records = array();
        if (false !== $handle = fopen($filename, 'r')) {
            while ($record = fgetcsv($handle, 0, ';')) {
                $records[] = $record;
            }
        }
        fclose($handle);

        return $records;
    }
}

<?php

declare(strict_types=1);

namespace solid\Loader;

class CsvLoader extends FileLoader implements LoaderInterface
{
    public function load(): array
    {
        $records = array();
        if (false !== $handle = fopen($this->filename, 'r')) {
            while ($record = fgetcsv($handle, 0, ';')) {
                $records[] = $record;
            }
        }
        fclose($handle);

        return $records;
    }
}

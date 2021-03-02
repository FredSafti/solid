<?php

declare(strict_types=1);

namespace solid;

class Loader
{
    public function load(string $file): array
    {
        $records = array();
        if (false !== $handle = fopen($file, 'r')) {
            while ($record = fgetcsv($handle, 0, ';')) {
                $records[] = $record;
            }
        }
        fclose($handle);

        return $records;
    }
}

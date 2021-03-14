<?php

declare(strict_types=1);

namespace solid;

class Loader
{
    private string $filename;

    public function __construct(string $filename)
    {
        $this->filename = $filename;
    }

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

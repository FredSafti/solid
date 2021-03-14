<?php

declare(strict_types=1);

namespace solid\Loader;

use DateTimeImmutable;

class JsonLoader extends CsvLoader
{
    private function loadFile(string $filename): array
    {
        return json_decode(file_get_contents($filename), true);
    }

    public function load(string $filename): array
    {
        $content = $this->loadFile($filename);

        return array_map(
            fn ($value) => array_values($value),
            $content['users']
        );
    }

    public function getDate(string $filename): DateTimeImmutable
    {
        $content = $this->loadFile($filename);

        return new DateTimeImmutable($content['updatedAt']);
    }
}

<?php

declare(strict_types=1);

namespace solid\Loader;

class FileLoader
{
    public function load(string $filename): array
    {
        return json_decode(file_get_contents($filename), true);
    }
}

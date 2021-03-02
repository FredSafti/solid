<?php

declare(strict_types=1);

namespace solid\Loader;

class FileLoader
{
    public function load(string $filename): array
    {
        return unserialize(file_get_contents($filename));
    }
}

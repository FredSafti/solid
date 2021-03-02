<?php

declare(strict_types=1);

namespace solid\Loader;

class FileLoader implements LoaderInterface
{
    protected string $filename;

    public function __construct(string $filename)
    {
        $this->filename = $filename;
    }

    public function load(): array
    {
        return unserialize(file_get_contents($this->filename));
    }
}

<?php

declare(strict_types=1);

namespace solid\Loader;

abstract class AbstractLoader
{
    abstract public function load(string $filename): array;
}

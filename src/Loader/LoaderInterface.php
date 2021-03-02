<?php

declare(strict_types=1);

namespace solid\Loader;

interface LoaderInterface
{
    public function load(): array;
}

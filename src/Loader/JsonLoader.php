<?php

declare(strict_types=1);

namespace solid\Loader;

use DateTimeImmutable;

class JsonLoader implements LoaderInterface
{
    private string $filename;
    private array $content = [];

    public function __construct(string $filename)
    {
        $this->filename = $filename;
    }

    private function loadFile(): void
    {
        if (empty($this->content)) {
            $this->content = json_decode(file_get_contents($this->filename), true);
        }
    }

    public function load(): array
    {
        $this->loadFile();

        return array_map(
            fn ($value) => array_values($value),
            $this->content['users']
        );
    }

    public function getDate(): DateTimeImmutable
    {
        $this->loadFile();

        return new DateTimeImmutable($this->content['updatedAt']);
    }
}

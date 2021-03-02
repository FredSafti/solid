<?php

namespace solid;

class CsvDataImporter
{
    private Loader $loader;
    private Repository $repository;

    public function __construct(Loader $loader, Repository $repository)
    {
        $this->loader = $loader;
        $this->repository = $repository;
    }

    public function import($file): void
    {
        $records = $this->loader->load($file);
        $this->repository->save($records);
    }
}

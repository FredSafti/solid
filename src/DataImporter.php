<?php

namespace solid;

use solid\Loader\CsvLoader;
use solid\Repository\AbstractRepository;

class DataImporter
{
    private CsvLoader $loader;
    private AbstractRepository $repository;

    public function __construct(CsvLoader $loader, AbstractRepository $repository)
    {
        $this->loader = $loader;
        $this->repository = $repository;
    }

    public function import(): void
    {
        $records = $this->loader->load();
        $this->repository->save($records);
    }
}

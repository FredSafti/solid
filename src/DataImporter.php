<?php

namespace solid;

use solid\Loader\AbstractLoader;
use solid\Repository\AbstractRepository;

class DataImporter
{
    private AbstractLoader $loader;
    private AbstractRepository $repository;

    public function __construct(AbstractLoader $loader, AbstractRepository $repository)
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

<?php

namespace solid;

use solid\Loader\FileLoader;
use solid\Repository\AbstractRepository;

class DataImporter
{
    private FileLoader $loader;
    private AbstractRepository $repository;

    public function __construct(FileLoader $loader, AbstractRepository $repository)
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

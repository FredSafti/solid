<?php

namespace solid;

use solid\Loader\LoaderInterface;
use solid\Repository\AbstractRepository;

class DataImporter
{
    private LoaderInterface $loader;
    private AbstractRepository $repository;

    public function __construct(LoaderInterface $loader, AbstractRepository $repository)
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

<?php

declare(strict_types=1);

namespace solid\Repository;

interface UserListsInterface
{
    public function getActives(): array;
}

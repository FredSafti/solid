<?php

declare(strict_types=1);

namespace solid\Repository;

class UserRepository extends AbstractRepository
{
    public function beforeSave(): void
    {
        $this->db->exec('DELETE FROM users');
    }

    public function insert(array $record): void
    {
        $this->db->prepare('INSERT INTO users (id, login, fullname) VALUES (?, ?, ?)')
            ->execute($record);
    }
}

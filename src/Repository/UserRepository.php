<?php

declare(strict_types=1);

namespace solid\Repository;

class UserRepository extends AbstractRepository
{
    public function beforeSave(): void
    {
        $stmt = $this->db->prepare('DELETE FROM users');
        $stmt->execute();
    }

    public function insert(array $record): void
    {
        $stmt = $this->db->prepare('INSERT INTO users VALUES (?, ?, ?)');
        $stmt->execute($record);
    }
}

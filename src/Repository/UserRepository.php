<?php

declare(strict_types=1);

namespace solid\Repository;

class UserRepository extends AbstractRepository implements UserListsInterface
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

    public function getActives(): array
    {
        $stmt = $this->db->prepare('SELECT * FROM users WHERE active = 1');
        $stmt->execute();
        return $stmt->fetchAll();
    }
}

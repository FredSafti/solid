<?php

declare(strict_types=1);

namespace solid\Repository;

class UserRepository extends AbstractRepository implements UserListsInterface
{
    public function beforeSave(): void
    {
        $stmt = $this->db->prepare('TRUNCATE users');
        $stmt->execute();
    }

    public function insert(array $record): void
    {
        $stmt = $this->db->prepare('INSERT INTO users VALUES (?, ?, ?)');
        $stmt->execute($record);
    }

    public function getActives(): array
    {
        $stmt = $this->db->prepare('SELECT * FROM users WHERE active = 1');
        $stmt->execute();
        return $stmt->fetchAll();
    }
}

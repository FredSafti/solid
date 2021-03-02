<?php

declare(strict_types=1);

namespace solid\Repository;

class ImportedRepository extends AbstractRepository
{
    public function beforeSave(): void
    {
        $stmt = $this->db->prepare('DELETE FROM imported');
        $stmt->execute();
    }

    public function insert(array $record): void
    {
        $stmt = $this->db->prepare('INSERT INTO imported VALUES (?, ?, ?)');
        $stmt->execute($record);
    }
}

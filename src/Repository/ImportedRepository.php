<?php

declare(strict_types=1);

namespace solid\Repository;

class ImportedRepository extends AbstractRepository
{
    public function beforeSave(): void
    {
        $this->db->exec('DELETE FROM imported');
    }

    public function insert(array $record): void
    {
        $this->db->prepare('INSERT INTO imported VALUES (?, ?, ?)')
            ->execute($record);
    }
}

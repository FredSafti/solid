<?php

declare(strict_types=1);

namespace solid\Repository;

use PDO;
use PDOException;

abstract class AbstractRepository
{
    protected PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    abstract protected function beforeSave(): void;
    abstract protected function insert(array $record): void;

    public function save(array $records): void
    {
        try {
            $this->db->beginTransaction();

            $this->beforeSave();

            foreach ($records as $record) {
                $this->insert($record);
            }

            $this->db->commit();

        } catch (PDOException $e) {
            $this->db->rollback();
            throw $e;
        }
    }

    public function getCount(): int
    {
        $data = $this->db->query('SELECT COUNT(*) AS nb FROM imported')
            ->fetch();

        return (int) $data['nb'];
    }
}

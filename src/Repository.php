<?php

declare(strict_types=1);

namespace solid;

use PDO;
use PDOException;

class Repository
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function save(array $records): void
    {
        try {
            $this->db->beginTransaction();

            $this->db->exec('DELETE FROM imported');

            foreach ($records as $record) {
                $this->db->prepare('INSERT INTO imported VALUES (?, ?, ?)')
                    ->execute($record);
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

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

            $stmt = $this->db->prepare('DELETE FROM imported');
            $stmt->execute();

            foreach ($records as $record) {
                $stmt = $this->db->prepare('INSERT INTO imported VALUES (?, ?, ?)');
                $stmt->execute($record);
            }

            $this->db->commit();

        } catch (PDOException $e) {
            $this->db->rollback();
            throw $e;
        }
    }

    public function getCount(): int
    {
        $stmt = $this->db->prepare('SELECT COUNT(*) AS nb FROM imported');
        $stmt->execute();
        $res = $stmt->fetch();

        return (int) $res['nb'];
    }
}

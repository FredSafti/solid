<?php

namespace solid;

use PDO;
use PDOException;

class CsvDataImporter
{
    private PDO $db;
    private Loader $loader;

    public function __construct(Loader $loader, PDO $db)
    {
        $this->db = $db;
        $this->loader = $loader;
    }

    public function import($file): void
    {
        $records = $this->loader->load($file);
        $this->importData($records);
    }

    private function importData(array $records): void
    {
        try {
            $this->db->beginTransaction();

            $stmt = $this->db->prepare('TRUNCATE imported');
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
}

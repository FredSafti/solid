<?php

namespace solid;

use PDO;
use PDOException;

class CsvDataImporter
{
    private const DB_DSN = 'mysql:host=localhost;port=3306;dbname=test';
    private const DB_USER = 'root';
    private const DB_PASSW = 'mysql';

    private PDO $db;

    public function __construct()
    {
        $this->db = new PDO(self::DB_DSN, self::DB_USER, self::DB_PASSW);
    }

    public function import($file): void
    {
        $records = $this->loadFile($file);

        $this->importData($records);
    }

    private function loadFile($file): array
    {
        $records = array();
        if (false !== $handle = fopen($file, 'r')) {
            while ($record = fgetcsv($handle)) {
                $records[] = $record;
            }
        }
        fclose($handle);

        return $records;
    }

    private function importData(array $records): void
    {
        try {
            $this->db->beginTransaction();

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

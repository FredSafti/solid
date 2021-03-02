<?php

namespace solid;

use PDO;
use PDOException;

class CsvDataImporter
{
    private const DB_DSN = 'mysql:host=localhost;port=3306;dbname=solid';
    private const DB_USER = 'solid';
    private const DB_PASSW = 'local';

    private PDO $db;

    public function import($file): void
    {
        $this->db = new PDO(self::DB_DSN, self::DB_USER, self::DB_PASSW);

        $records = $this->loadFile($file);
        $this->importData($records);
    }

    private function loadFile($file): array
    {
        $records = array();
        if (false !== $handle = fopen($file, 'r')) {
            while ($record = fgetcsv($handle, 0, ';')) {
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

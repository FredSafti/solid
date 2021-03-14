<?php

namespace solid;

use PDO;
use PDOException;

class CsvDataImporter
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
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

            $this->db->exec('TRUNCATE imported');

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
}

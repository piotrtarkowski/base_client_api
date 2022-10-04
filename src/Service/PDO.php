<?php

namespace BaseClientApi\Service;

class PDO
{
    private \PDO $db;

    public function __construct()
    {
        try {

            $this->db = new \PDO('sqlite:' . APP_DATA . '/database');
        } catch (\Exception $e) {
            throw new \Exception('Błąd połączenia do bazy danych');
        }
    }

    public function connect(): \PDO
    {
        return $this->db;
    }
}
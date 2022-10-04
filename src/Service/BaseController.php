<?php

namespace BaseClientApi\Service;

class BaseController
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = new PDO();
    }

    public function getParam($name)
    {
        if (!empty($_POST[$name])) {
            return $_POST[$name];
        }

        return [];
    }

    public function getParams()
    {

        if ($this->isPost()) {
            return $_POST;
        }

        return [];
    }

    public function isPost()
    {

        if (isset($_POST) && $_POST) {
            return true;
        }

        return false;
    }

    public function db(): \PDO
    {
        return $this->pdo->connect();
    }

    public function json(array $data)
    {
        echo json_encode($data);
        exit;
    }
}
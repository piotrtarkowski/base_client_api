<?php

namespace BaseClientApi\Controller;

use BaseClientApi\Service\BaseController;
use BaseClientApi\Service\PDO;

class MainController extends BaseController
{


    public function index()
    {
        $pdo = new PDO();
        $stmt = $this->db()->prepare('select * from client');
        $stmt->execute();
        $clientList = $stmt->fetchAll(\PDO::FETCH_ASSOC);


        $this->json([
            'list' => $clientList
        ]);
    }

    public function new()
    {
        if ($this->isPost()) {
            $data = $this->getParams();

            $stmt = $this->db()->prepare('insert into client (`firstname`,`surname`) values (:firstname, :surname)');
            $stmt->execute($data);

            $message = 'Succeful add new data to database';
        }


        $this->json([
            'message' => $message
        ]);
    }

    public function edit($id)
    {
        $message = 'Not found data';

        if ($this->isPost()) {
            $data = $this->getParams();
            $message = sprintf('Succeful edit in database id: %s', $id);
            $data = array_merge($data, ['id' => $id]);

            $stmt = $this->db()->prepare('update client set `firstname` = :firstname, `surname` = :surname where id = :id');

            $stmt->execute($data);
        }

        $this->json([
            'message' => $message
        ]);
    }

    public function delete($id)
    {

        $stmt = $this->db()->prepare('delete from client where id = :id');
        $stmt->execute();

        $this->json([
            'message' => sprintf('Succeful delete from database id: %s', $id)
        ]);
    }

}
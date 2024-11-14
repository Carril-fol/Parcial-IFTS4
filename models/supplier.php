<?php
require_once  __DIR__ . '/../config/db.php';

class Supplier
{
    private $db;
    public $id;
    public $cuil;
    public $name;

    public function __construct(
        $id = null,
        $cuil = null,
        $name = ""
    )
    {
        $this->db = (new Database())->connection();
        $this->id = $id;
        $this->cuil = $cuil;
        $this->name = $name;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getCuil(): int
    {
        return $this->cuil;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function setCuil($cuil): void
    {
        $this->cuil = $cuil;
    }

    public function setName($name): void
    {
        $this->name = $name;
    }

    public function getDataFromSupplierByCuil($cuil): mixed
    {
        $this->setCuil($cuil);
        $paramsQuery = [":cuil" => $this->cuil];
        $selectQuery = "SELECT * FROM suppliers WHERE cuil = :cuil";
        $resultQuery = $this->db->prepare($selectQuery);
        $resultQuery->execute($paramsQuery);
        return $resultQuery->fetch(PDO::FETCH_ASSOC);
    }

    public function checkIfSupplierExists()
    {
        $paramsQuery = [":cuil" => $this->cuil];
        $selectQuery = "SELECT cuil FROM suppliers WHERE cuil = :cuil";
        $resultQuery = $this->db->prepare($selectQuery);
        $resultQuery->execute($paramsQuery);
        return $resultQuery->rowCount();
    }

    public function createSupplier(): bool
    {
        $paramsQuery = [":cuil" => $this->cuil, ":name" => $this->name];
        $insertQuery = "INSERT INTO suppliers (cuil, name) VALUES (:cuil, :name)";
        $resultQuery = $this->db->prepare($insertQuery);
        return $resultQuery->execute($paramsQuery);
    }
}
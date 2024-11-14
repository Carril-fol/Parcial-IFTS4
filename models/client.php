<?php
require_once  __DIR__ . '/../config/db.php';

class Client
{
    private $db;
    public $id;
    public $dni;
    public $firstName;
    public $lastName;
    public $email;
    public $phone;

    public function __construct(
        $id = null,
        $dni = null,
        $firstName = "",
        $lastName = "",
        $email = "",
        $phone = ""
    ) {
        $this->db = (new Database())->connection();
        $this->id = $id;
        $this->dni = $dni;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->phone = $phone;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getDni(): int
    {
        return $this->dni;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setDni(int $dni): void
    {
        $this->dni = $dni;
    }

    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }

    public function getDataFromClientByDni($dni): mixed
    {
        $this->setDni($dni);
        $paramsQuery = [":dniClient" => $this->dni];
        $selectQuery = "SELECT * FROM clients WHERE dni = :dniClient";
        $resultQuery = $this->db->prepare($selectQuery);
        $resultQuery->execute($paramsQuery);
        return $resultQuery->fetch(PDO::FETCH_ASSOC);
    }

    public function checkIfClientExists()
    {
        $paramsQuery = [":dni" => $this->dni];
        $selectQuery = "SELECT dni FROM clients WHERE dni = :dni";
        $resultQuery = $this->db->prepare($selectQuery);
        $resultQuery->execute($paramsQuery);
        return $resultQuery->rowCount();
    }

    public function createClient(): bool
    {
        $paramsQuery = [
            ":dni" => $this->dni,
            ":firstName" => $this->firstName,
            ":lastName" => $this->lastName,
            ":email" => $this->email,
            ":phone" => $this->phone
        ];
        $insertQuery = "INSERT INTO clients (dni, firstName, lastName, email, phone) VALUES (:dni, :firstName, :lastName, :email, :phone)";
        $resultQuery = $this->db->prepare($insertQuery);
        return $resultQuery->execute($paramsQuery);
    }
}

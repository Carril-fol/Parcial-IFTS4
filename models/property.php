<?php
require_once  __DIR__ . '/../config/db.php';

class Property
{
    private $db;
    public $id;
    public $idClient;
    public $idSupplier;
    public $domicile;
    public $paidAmount;
    public $spentAmount;
    public $status;

    public function __construct(
        $id = null,
        $idClient = null,
        $idSupplier = null,
        $domicile = "",
        $paidAmount = null,
        $spentAmount = null,
        $status = ""
    ) {
        $this->db = (new Database())->connection();
        $this->id = $id;
        $this->idClient = $idClient;
        $this->idSupplier = $idSupplier;
        $this->domicile = $domicile;
        $this->paidAmount = $paidAmount;
        $this->spentAmount = $spentAmount;
        $this->status = $status;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getIdClient(): int
    {
        return $this->idClient;
    }

    public function getIdSupplier(): int
    {
        return $this->idSupplier;
    }

    public function getDomicile(): string
    {
        return $this->domicile;
    }

    public function getPaidAmount(): int
    {
        return $this->paidAmount;
    }

    public function getSpentAmount(): int
    {
        return $this->spentAmount;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setIdClient(int $idClient): void
    {
        $this->idClient = $idClient;
    }

    public function setIdSupplier(int $idSupplier): void
    {
        $this->idSupplier = $idSupplier;
    }

    public function setDomicile(string $domicile): void
    {
        $this->domicile = $domicile;
    }

    public function setPaidAmount(int $paidAmount): void
    {
        $this->paidAmount = $paidAmount;
    }

    public function setSpentAmount(int $spentAmount): void
    {
        $this->spentAmount = $spentAmount;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    public function createProperty(): bool
    {
        $paramsQuery = [
            ":idClient" => $this->idClient,
            ":idSupplier" => $this->idSupplier,
            ":domicile" => $this->domicile,
            ":paidAmount" => $this->paidAmount,
            ":spentAmount" => $this->spentAmount,
            ":status" => $this->status
        ];
        $insertQuery = "INSERT INTO properties (idClient, idSupplier, domicile, fanAmount, spentAmount, status) VALUES (:idClient, :idSupplier, :domicile, :paidAmount, :spentAmount, :status)";
        $resultQuery = $this->db->prepare($insertQuery);
        return $resultQuery->execute($paramsQuery);
    }

    public function getAllProperties()
    {
        $selectQuery = "SELECT c.dni, p.*, s.cuil
            FROM properties AS p
            JOIN clients AS c ON p.idClient = c.id
            JOIN suppliers as s ON p.idSupplier = s.id
            WHERE p.status != 'BAJA'";
        $resultQuery = $this->db->prepare($selectQuery);
        $resultQuery->execute();
        return $resultQuery->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deletePropertyById($id)
    {
        $this->setId($id);
        $paramsQuery = [":id" => $this->id];
        $updateQuery = "UPDATE properties SET status = 'BAJA' WHERE id = :id";
        $resultQuery = $this->db->prepare($updateQuery);
        return $resultQuery->execute($paramsQuery);
    }

    public function detailPropertyById($id)
    {
        $this->setId($id);
        $paramsQuery = [":id" => $this->id];
        $selectQuery = "SELECT c.dni, p.*, s.cuil
            FROM properties AS p
            JOIN clients AS c ON p.idClient = c.id
            JOIN suppliers as s ON p.idSupplier = s.id
            WHERE p.id = :id";
        $resultQuery = $this->db->prepare($selectQuery);
        $resultQuery->execute($paramsQuery);
        return $resultQuery->fetch(PDO::FETCH_ASSOC);
    }

    public function updatePropertyById($id): bool
    {
        $this->setId($id);
        $paramsQuery = [
            ":idClient" => $this->idClient,
            ":idSupplier" => $this->idSupplier,
            ":domicile" => $this->domicile,
            ":paidAmount" => $this->paidAmount,
            ":spentAmount" => $this->spentAmount,
            ":status" => $this->status,
            ":id" => $this->id
        ];
        $insertQuery = "UPDATE properties
            SET idClient = :idClient,
            idSupplier = :idSupplier,
            domicile = :domicile,
            fanAmount = :paidAmount,
            spentAmount = :spentAmount,
            status = :status
            WHERE id = :id";
        $resultQuery = $this->db->prepare($insertQuery);
        return $resultQuery->execute($paramsQuery);
    }

    public function getAllPropertiesWithPerformance()
    {
        $selectQuery = "SELECT c.dni, p.*, s.cuil, (p.fanAmount - p.spentAmount) AS remainingAmount
            FROM properties AS p
            JOIN clients AS c ON p.idClient = c.id
            JOIN suppliers as s ON p.idSupplier = s.id
            WHERE (p.fanAmount - p.spentAmount) > 0";
        $resultQuery = $this->db->prepare($selectQuery);
        $resultQuery->execute();
        return $resultQuery->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllPropertiesUnoccupied()
    {
        $selectQuery = "SELECT c.dni, p.*, s.cuil
            FROM properties AS p
            JOIN clients AS c ON p.idClient = c.id
            JOIN suppliers as s ON p.idSupplier = s.id
            WHERE p.status = 'DESOCUPADO'";
        $resultQuery = $this->db->prepare($selectQuery);
        $resultQuery->execute();
        return $resultQuery->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllPropertiesAmountTotalYear()
    {
        $selectQuery = "SELECT c.dni, p.*, s.cuil, (p.fanAmount * 12) AS totalMount
            FROM properties AS p
            JOIN clients AS c ON p.idClient = c.id
            JOIN suppliers as s ON p.idSupplier = s.id
            WHERE (p.fanAmount - p.spentAmount) > 0";
        $resultQuery = $this->db->prepare($selectQuery);
        $resultQuery->execute();
        return $resultQuery->fetchAll(PDO::FETCH_ASSOC);
    }
}
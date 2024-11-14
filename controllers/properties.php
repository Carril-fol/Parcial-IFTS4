<?php
require_once __DIR__ . "/controller.php";

require_once __DIR__ . "/../models/property.php";
require_once __DIR__ . "/../models/client.php";
require_once __DIR__ . "/../models/supplier.php";

class PropertyController extends Controller
{
    public $propertyModel;
    public $clientModel;
    public $supplierModel;

    public function __construct()
    {
        $this->propertyModel = new Property();
        $this->clientModel = new Client();
        $this->supplierModel = new Supplier();
    }

    private function getDataFromForm()
    {
        return [
            "dniClient" => $this->sanitizeInput($_POST["dniClient"]),
            "cuilSupplier" => $this->sanitizeInput($_POST["cuilSupplier"]),
            "domicilie" => strtoupper($this->sanitizeInput($_POST["domicilie"])),
            "paidAmount" => $this->sanitizeInput($_POST["paidAmount"]),
            "spentAmount" => $this->sanitizeInput($_POST["spentAmount"]),
            "status" => strtoupper($this->sanitizeInput($_POST["status"]))
        ];
    }

    private function actualizePropery($data, $id)
    {
        $clientData = $this->clientModel->getDataFromClientByDni($data["dniClient"]);
        if ($clientData == false) {
            throw new Exception("No existe un cliente con el DNI ingresado\nPor favor introduzca uno nuevamente");
        }
        $supplierData = $this->supplierModel->getDataFromSupplierByCuil($data["cuilSupplier"]);
        if ($supplierData == false) {
            throw new Exception("No existe un proveedor con el CUIL ingresado\nPor favor introduzca uno nuevamente");
        }
        $this->propertyModel->setIdClient($clientData["id"]);
        $this->propertyModel->setIdSupplier($supplierData["id"]);
        $this->propertyModel->setDomicile($data["domicilie"]);
        $this->propertyModel->setpaidAmount($data["paidAmount"]);
        $this->propertyModel->setSpentAmount($data["spentAmount"]);
        $this->propertyModel->setStatus($data["status"]);
        $this->propertyModel->updatePropertyById($id);
        $this->redirectToHome();
    }

    public function createProperty()
    {
        try {
            $data = $this->getDataFromForm();
            $clientData = $this->clientModel->getDataFromClientByDni($data["dniClient"]);
            if ($clientData == false) {
                throw new Exception("No existe un cliente con el DNI ingresado\nPor favor introduzca uno nuevamente");
            }
            $supplierData = $this->supplierModel->getDataFromSupplierByCuil($data["cuilSupplier"]);
            if ($supplierData == false) {
                throw new Exception("No existe un proveedor con el CUIL ingresado\nPor favor introduzca uno nuevamente");
            }
            $this->propertyModel->setIdClient($clientData["id"]);
            $this->propertyModel->setIdSupplier($supplierData["id"]);
            $this->propertyModel->setDomicile($data["domicilie"]);
            $this->propertyModel->setpaidAmount($data["paidAmount"]);
            $this->propertyModel->setSpentAmount($data["spentAmount"]);
            $this->propertyModel->setStatus($data["status"]);
            $this->propertyModel->createProperty();
            $this->redirectToHome();
        } catch (Exception $error) {
            session_start();
            $_SESSION['error'] = $error->getMessage();
            header("Location: ../views/properties/createProperty.php");
            exit();
        }
    }

    public function showProperties()
    {
        return $this->propertyModel->getAllProperties();
    }

    public function deleteProperty()
    {
        $id = $this->getIdUrl();
        $this->propertyModel->deletePropertyById($id);
        $this->redirectToHome();
    }

    public function detailProperty()
    {
        try {
            $id = $this->getIdUrl();
            return $this->propertyModel->detailPropertyById($id);
        } catch (Exception $error) {
            session_start();
            $_SESSION['error'] = $error->getMessage();
            $this->redirectToHome();
        }
    }

    public function detailPropertiesWithPerformance()
    {
        return $this->propertyModel->getAllPropertiesWithPerformance();
    }

    public function detailPropertiesUnoccupied()
    {
        return $this->propertyModel->getAllPropertiesUnoccupied();
    }

    public function detailPropertiesAmountTotalYear()
    {
        return $this->propertyModel->getAllPropertiesAmountTotalYear();
    }

    public function updateProperty()
    {
        try {
            $requestMethod = $_SERVER['REQUEST_METHOD'];
            $id = $this->getIdUrl();
            if ($requestMethod == "GET") {
                return $this->detailProperty();
            } elseif ($requestMethod == "POST") {
                $propertyFormUpdateData = $this->getDataFromForm();
                $this->actualizePropery($propertyFormUpdateData, $id);
            };
        } catch (Exception $error) {
            session_start();
            $_SESSION['error'] = $error->getMessage();
            header("Location: ../views/properties/updateProperty.php?action=update&id=" . $id);
            exit();
        }
    }

    public function renewStatePropery()
    {
        try {
            $id = $this->getIdUrl();
            $this->propertyModel->setId($id);
            $this->propertyModel->setStatus("DESOCUPADO");
            $this->propertyModel->updateStatusPropertyById();
            $this->redirectToHome();
        } catch (Exception $error) {
            session_start();
            $_SESSION['error'] = $error->getMessage();
            $this->redirectToHome();
            exit();
        }
    }
}

$controller = new PropertyController();
$action = $controller->getActionInUrl();

switch ($action) {
    case "create":
        $controller->createProperty();
        break;
    case "delete":
        $controller->deleteProperty();
        break;
    case "update":
        $controller->updateProperty();
        break;
    case "renew-state":
        $controller->renewStatePropery();
        break;
}

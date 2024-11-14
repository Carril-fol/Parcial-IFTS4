<?php
require_once __DIR__ . "/controller.php";

require_once __DIR__ . "/../models/supplier.php";

class SupplierController extends Controller
{
    private $supplierModel;

    public function __construct()
    {
        $this->supplierModel = new Supplier();
    }

    private function getDataFromForm()
    {
        return [
            "cuil" => $this->sanitizeInput($_POST["cuil"]),
            "name" => $this->sanitizeInput(strtoupper($_POST["name"]))
        ];
    }

    public function createSupplier()
    {
        try {
            $data = $this->getDataFromForm();
            $this->supplierModel->setCuil($data["cuil"]);
            $checkIfSupplierExists = $this->supplierModel->checkIfSupplierExists();
            if ($checkIfSupplierExists > 0) {
                throw new Exception("Ya existe un proveedor con el CUIL ingresado.");
            }
            $this->supplierModel->setName($data["name"]);
            $this->supplierModel->createSupplier();
            $this->redirectToHome();
        } catch (Exception $error) {
            session_start();
            $_SESSION['error'] = $error->getMessage();
            header("Location: ../views/suppliers/createSuppliers.php");
            exit();
        }
    }

}

$controller = new SupplierController();
$action = $controller->getActionInUrl();
switch ($action) {
    case "create":
        $controller->createSupplier();
        break;
}
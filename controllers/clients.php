<?php
require_once __DIR__ . "/controller.php";

require_once __DIR__ . "/../models/client.php";

class ClientController extends Controller
{
    private $clientModel;

    public function __construct()
    {
        $this->clientModel = new Client();
    }

    private function getDataFromForm()
    {
        return [
            "dni" => $this->sanitizeInput(strtoupper($_POST["dniClient"])),
            "firstName" => $this->sanitizeInput(strtoupper($_POST["firstName"])),
            "lastName" => $this->sanitizeInput(strtoupper($_POST["lastName"])),
            "email" => $this->sanitizeInput($_POST["email"]),
            "phone" => $this->sanitizeInput($_POST["phone"]),
        ];
    }

    public function createClient()
    {
        try {
            $data = $this->getDataFromForm();
            $this->clientModel->setDni($data["dni"]);
            $checkIfClientExists = $this->clientModel->checkIfClientExists();
            if ($checkIfClientExists > 0) {
                throw new Exception("El DNI ingresado esta ligado a otro cliente.");
            } else {
                $this->clientModel->setFirstName($data["firstName"]);
                $this->clientModel->setLastName($data["lastName"]);
                $this->clientModel->setEmail($data["email"]);
                $this->clientModel->setPhone($data["phone"]);
                $this->clientModel->createClient();
                $this->redirectToHome();
            }
        } catch (Exception $error) {
            session_start();
            $_SESSION['error'] = $error->getMessage();
            header("Location: ../views/clients/createClient.php");
            exit();
        }
    }
}

$controller = new ClientController();
$action = $controller->getActionInUrl();
switch ($action) {
    case "create":
        $controller->createClient();
        break;
}

<?php
require_once __DIR__ . "/../../controllers/clients.php";
$controller = new ClientController();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/properties/Property.css">
    <link rel="stylesheet" href="../../assets/css/App.css">
    <title>Inmuebles</title>
</head>

<body>
    <header>
        <div class="logo">
            <a href="../../index.php">
                <img src="../../assets/images/logo-white.webp" alt="logo" />
            </a>
        </div>
    </header>
    <section class="section-property">
        <div>
            <?php $controller->errorInSession(); ?>
        </div>
        <form class="form-property-creation" method="POST" action="../../controllers/clients.php?action=create">
            <div class="container-fields-form-turn">
                <div class="form-header">
                    <h1>Registro de Clientes</h1>
                </div>
                <div class="container-field">
                    <label for="dniClient">DNI del Cliente</label>
                    <input type="number" name="dniClient" pattern="^\d{7,8}$" title="El DNI debe tener entre 7 y 8 dígitos numéricos" required>
                </div>
                <div class="container-field">
                    <label for="firstName">Nombre</label>
                    <input type="text" name="firstName" required>
                </div>
                <div class="container-field">
                    <label for="lastName">Apellido</label>
                    <input type="text" name="lastName">

                </div>
                <div class="container-field">
                    <label for="email">Email</label>
                    <input type="text" placeholder="example@hotmail.com" name="email">
                </div>
                <div class="container-field">
                    <label for="phone">Telefono celular</label>
                    <input type="number" name="phone">
                </div>
                <div class="container-form-button-submit">
                    <button type="submit" class="submit-button">Dar alta</button>
                </div>
            </div>
        </form>
    </section>
</body>

</html>
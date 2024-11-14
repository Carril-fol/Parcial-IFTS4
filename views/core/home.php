<?php
require_once __DIR__ . "/../../controllers/controller.php";
$controller = new Controller();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/App.css">
    <title>Inmuebles</title>
</head>
<body>
    <header>
        <nav>
            <div class="logo">
                <a href="index.php">
                    <img src="assets/images/logo-white.webp" alt="logo" />
                </a>
            </div>
        </nav>
    </header>
    <section class="section-home">
        <?php $controller->errorInSession(); ?>
        <div class="container-table">
            <?php include "views/properties/tableProperties.php"; ?>
        </div>
    </section>
</body>
</html>
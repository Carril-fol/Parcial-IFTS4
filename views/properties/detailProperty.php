<?php
require_once __DIR__ . "/../../controllers/properties.php";
$controller = new PropertyController();
$dataProperty = $controller->detailProperty();
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
        <div class="card-detail">
            <div class="container-fields-form-turn">
                <div class="form-header">
                    <h1>Detalle de Inmobiliario</h1>
                </div>
                <div class="container-field">
                    <label>DNI del Cliente</label>
                    <p><?php echo $dataProperty["dni"]; ?></p>
                </div>
                <div class="container-field">
                    <label>CUIL del Cliente</label>
                    <p><?php echo $dataProperty["cuil"]; ?></p>
                </div>
                <div class="container-field">
                    <label>Dirección del inmueble</label>
                    <p><?php echo $dataProperty["domicile"]; ?></p>
                </div>
                <div class="container-field">
                    <label>Monton abonado</label>
                    <p>$ <?php echo $dataProperty["fanAmount"]; ?></p>
                </div>
                <div class="container-field">
                    <label>Monton abonado</label>
                    <p>$ <?php echo $dataProperty["spentAmount"]; ?></p>
                </div>
                <div class="container-field">
                    <label>Monton abonado</label>
                    <p><?php echo $dataProperty["status"]; ?></p>
                </div>
            </div>
    </section>
</body>

</html>
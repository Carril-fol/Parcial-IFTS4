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
        <nav>
            <a href="#">Logout</a>
        </nav>
    </header>
    <section class="section-property">
        <div>
            <?php $controller->errorInSession(); ?>
        </div>
        <form class="form-property-creation" method="POST" action="../../controllers/properties.php?action=update&id=<?php echo $dataProperty["id"] ?>">
            <div class="container-fields-form-turn">
                <div class="form-header">
                    <h1>Actualizar Inmobiliario</h1>
                </div>
                <div class="container-field">
                    <label for="dniClient">DNI del Cliente</label>
                    <input value="<?php echo $dataProperty["dni"] ?>" type="number" name="dniClient" pattern="^\d{7,8}$" title="El DNI debe tener entre 7 y 8 dígitos numéricos" required>
                </div>
                <div class="container-field">
                    <label for="cuilSupplier">CUIL del Proveedor</label>
                    <input value="<?php echo $dataProperty["cuil"] ?>" type="text" name="cuilSupplier" title="El CUIL debe tener 12 caracteres (por ejemplo, 20123456789)" required>
                </div>
                <div class="container-field">
                    <label for="domicilie">Domicilio</label>
                    <input value="<?php echo $dataProperty["domicile"] ?>" type="text" name="domicilie">

                </div>
                <div class="container-field">
                    <label for="paidAmount">Monto Abonado</label>
                    <input value="<?php echo $dataProperty["fanAmount"] ?>" type="number" placeholder="$" name="paidAmount">
                </div>
                <div class="container-field">
                    <label for="spentAmount">Monto Gastado</label>
                    <input value="<?php echo $dataProperty["spentAmount"] ?>" type="number" placeholder="$" name="spentAmount">
                </div>
                <div class="container-field">
                    <label for="status">Seleccione el estado del Inmobiliario</label>
                    <select name="status">
                        <option value="ALQUILADO">ALQUILADO</option>
                        <option value="DESOCUPADO">DESOCUPADO</option>
                        <option value="SUSPENDIDA">SUSPENDIDA</option>
                    </select>
                </div>
                <div class="container-form-button-submit">
                    <button type="submit" class="submit-button">Actualizar</button>
                </div>
            </div>
        </form>
    </section>
</body>

</html>
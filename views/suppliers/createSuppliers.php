<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/properties/Property.css">
    <link rel="stylesheet" href="../../assets/css/suppliers/Supplier.css">
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
        <form class="form-supplier-creation" method="POST" action="../../controllers/suppliers.php?action=create">
            <div class="container-fields-form-turn">
                <div class="form-header">
                    <h1>Registro de Proveedores</h1>
                </div>
                <div class="container-field">
                    <label for="cuil">CUIL del Proveedor</label>
                    <input type="number" name="cuil" pattern="^\d{11,12}$" title="El DNI debe tener entre 11 y 12 dígitos numéricos" required>
                </div>
                <div class="container-field">
                    <label for="name">Nombre del Proveedor</label>
                    <input type="text" name="name" required>
                </div>
                <div class="container-form-button-submit">
                    <button type="submit" class="submit-button">Dar alta</button>
                </div>
            </div>
        </form>
    </section>
</body>
</html>
<?php
require_once "../../../controllers/properties.php";
$controller = new PropertyController();
$rows = $controller->detailPropertiesWithPerformance();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../assets/css/properties/Property.css">
    <link rel="stylesheet" href="../../../assets/css/App.css">
    <title>Inmobiliario</title>
</head>

<body>
    <header>
        <div class="logo">
            <a href="../../../index.php">
                <img src="../../../assets/images/logo-white.webp" alt="logo" />
            </a>
        </div>
    </header>
    <section class="section-home">
        <div class="container-table">
            <div class="container-table-button-top">
                <ul class="list-container-buttons">
                    <a href="propertiesPerformances.php">
                        <button type="submit">Ver inmuebles con rendimiento</button>
                    </a>
                    <a href="propertiesUnoccupied.php">
                        <button type="submit">Ver inmuebles desocupados</button>
                    </a>
                    <a href="propertiesAmountTotal.php">
                        <button type="submit">Ver total de pagos de inmuebles</button>
                    </a>
                    <div class="dropdown">
                        <button class="dropbtn">Opciones ▼</button>
                        <div class="dropdown-content">
                            <a href="../createProperty.php">
                                <button type="button">Dar de alta inmobiliario</button>
                            </a>
                            <a href="../../clients/createClient.php">
                                <button type="button">Dar de alta Cliente</button>
                            </a>
                            <a href="../../suppliers/createSuppliers.php">
                                <button type="button">Dar de alta Proveedor</button>
                            </a>
                        </div>
                    </div>
                </ul>
            </div>
            <table class="content-table">
                <thead>
                    <tr>
                        <th>DNI - Cliente</th>
                        <th>CUIL - Proveedor</th>
                        <th>Domicilio</th>
                        <th>Rendimiento</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <?php if (!empty($rows)): ?>
                    <?php foreach ($rows as $row): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['dni']); ?></td>
                            <td><?php echo htmlspecialchars($row['cuil']); ?></td>
                            <td><?php echo htmlspecialchars($row['domicile']); ?></td>
                            <td>$<?php echo htmlspecialchars($row['remainingAmount']); ?></td>
                            <td><?php echo htmlspecialchars($row['status']); ?></td>
                            <td>
                                <div class="container-buttons-table-aside">
                                    <a href="../updateProperty.php?action=update&id=<?php echo $row["id"]; ?>">
                                        <button class="table-button-update" type="button">Editar</button>
                                    </a>
                                    <a href="../detailProperty.php?action=detail&id=<?php echo $row["id"]; ?>">
                                        <button class="table-button-detail" type="button">Detalle</button>
                                    </a>
                                    <a href="controllers/properties.php?action=delete&id=<?php echo $row["id"]; ?>">
                                        <button class="table-button-delete" type="button">Eliminar</button>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7">No hay inmoboliarios a mostrar.</td>
                    </tr>
                <?php endif; ?>
            </table>
        </div>
    </section>
</body>

</html>
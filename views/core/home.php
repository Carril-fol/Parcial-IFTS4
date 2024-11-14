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
        <div class="logo">
            <a href="index.php">
                <img src="assets/images/logo-white.webp" alt="logo"/>
            </a>
        </div>
        <nav>
            <a href="#">Logout</a>
        </nav>
    </header>
    <section class="section-home">
        <div class="container-table">
            <?php include "views/properties/tableProperties.php"; ?>
        </div>
    </section>
</body>

</html>
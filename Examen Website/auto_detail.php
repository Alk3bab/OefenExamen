<?php
session_start();
include 'config.php'; // Verbind met de database

// Foutopsporing inschakelen
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Haal auto ID op
if (isset($_GET['id'])) {
    $auto_id = intval($_GET['id']); 

    // Query om auto-gegevens uit de database op te halen
    $query = "SELECT * FROM cars WHERE id = $auto_id";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $auto = mysqli_fetch_assoc($result); // Auto details ophalen

        // Haal foto's op voor deze auto uit de car_images tabel
        $query_images = "SELECT * FROM car_images WHERE car_id = $auto_id";
        $result_images = mysqli_query($conn, $query_images);
        $images = mysqli_fetch_all($result_images, MYSQLI_ASSOC); // Meerdere afbeeldingen ophalen
    } else {
        die("Auto niet gevonden.");
    }
} else {
    die("Geen auto geselecteerd.");
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $auto['merk'] . " " . $auto['model']; ?> - PremiumWagens</title>
    <link rel="stylesheet" href="css/auto_detail.css"> <!-- CSS bestand -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <!-- Navigatiebalk -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">PremiumWagens</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="occasions.php">Occasions</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <!-- Terug knop -->
        <a href="occasions.php" class="btn btn-outline-primary back-btn">Terug</a>
        
        <div class="car-detail-wrapper row">
            <!-- Hoofd afbeelding met carousel -->
            <div class="col-md-8 car-images">
                <div id="carCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <?php foreach ($images as $index => $image): ?>
                            <div class="carousel-item <?php if ($index == 0) echo 'active'; ?>">
                                <img src="<?php echo $image['image_url']; ?>" class="d-block w-100" alt="Foto van <?php echo $auto['merk']; ?>">
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Vorige</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Volgende</span>
                    </button>
                </div>

                <!-- Thumbnail navigatie -->
                <div class="thumbnail-container mt-3 d-flex justify-content-center">
                    <?php foreach ($images as $index => $image): ?>
                        <img src="<?php echo $image['image_url']; ?>" data-bs-target="#carCarousel" data-bs-slide-to="<?php echo $index; ?>" class="<?php if ($index == 0) echo 'active'; ?>" alt="Thumbnail van <?php echo $auto['merk']; ?>">
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Auto details -->
            <div class="col-md-4 car-info">
                <h1><?php echo $auto['merk'] . " " . $auto['model']; ?></h1>
                <p class="price">€<?php echo number_format($auto['prijs'], 2, ',', '.'); ?></p>
                <p class="location">Locatie: <?php echo isset($auto['locatie']) ? $auto['locatie'] : 'Onbekend'; ?></p>

                <!-- Compacte Info -->
                <div class="spec-grid mt-4">
                    <div class="spec-box">
                        <span class="spec-item">Kilometerstand</span>
                        <span class="spec-value"><?php echo isset($auto['kilometerstand']) ? $auto['kilometerstand'] : 'Onbekend'; ?> km</span>
                    </div>
                    <div class="spec-box">
                        <span class="spec-item">Transmissie</span>
                        <span class="spec-value"><?php echo isset($auto['transmissie']) ? $auto['transmissie'] : 'Onbekend'; ?></span>
                    </div>
                    <div class="spec-box">
                        <span class="spec-item">Bouwjaar</span>
                        <span class="spec-value"><?php echo $auto['bouwjaar']; ?></span>
                    </div>
                    <div class="spec-box">
                        <span class="spec-item">Brandstof</span>
                        <span class="spec-value"><?php echo isset($auto['brandstof']) ? $auto['brandstof'] : 'Onbekend'; ?></span>
                    </div>
                    <div class="spec-box">
                        <span class="spec-item">Vermogen kW (PK)</span>
                        <span class="spec-value"><?php echo isset($auto['vermogen']) ? $auto['vermogen'] . ' PK' : 'Onbekend'; ?></span>
                    </div>
                </div>

                <!-- Knoppen -->
                <div class="contact-options mt-4">
                    <a href="contact.php" class="btn btn-primary">Contact aanbieder</a>
                    <a href="tel:<?php echo isset($auto['telefoonnummer']) ? $auto['telefoonnummer'] : '#'; ?>" class="btn btn-secondary">Toon nummer</a>
                </div>
            </div>
        </div>

        <!-- Uitgebreide Informatie Sectie -->
        <div class="car-specifications mt-5">
            <h2>Uitgebreide Informatie</h2>
            <div class="row">
                <div class="col-md-4 spec-box">
                    <h3>Basisgegevens</h3>
                    <table class="table table-striped">
                        <tr><th>Carrosserietype</th><td><?php echo isset($auto['carrosserietype']) ? $auto['carrosserietype'] : 'Onbekend'; ?></td></tr>
                        <tr><th>Categorie</th><td><?php echo isset($auto['categorie']) ? $auto['categorie'] : 'Onbekend'; ?></td></tr>
                        <tr><th>Aandrijving</th><td><?php echo isset($auto['aandrijving']) ? $auto['aandrijving'] : 'Onbekend'; ?></td></tr>
                        <tr><th>Stoelen</th><td><?php echo isset($auto['stoelen']) ? $auto['stoelen'] : 'Onbekend'; ?></td></tr>
                        <tr><th>Deuren</th><td><?php echo isset($auto['deuren']) ? $auto['deuren'] : 'Onbekend'; ?></td></tr>
                        <tr><th>Advertentienr.</th><td><?php echo isset($auto['advertentienr']) ? $auto['advertentienr'] : 'Onbekend'; ?></td></tr>
                    </table>
                </div>

                <div class="col-md-4 spec-box">
                    <h3>Voertuiggeschiedenis</h3>
                    <table class="table table-striped">
                        <tr><th>Kilometerstand</th><td><?php echo isset($auto['kilometerstand']) ? $auto['kilometerstand'] : 'Onbekend'; ?> km</td></tr>
                        <tr><th>Bouwjaar</th><td><?php echo $auto['bouwjaar']; ?></td></tr>
                        <tr><th>APK</th><td><?php echo isset($auto['apk']) ? $auto['apk'] : 'Onbekend'; ?></td></tr>
                    </table>
                </div>

                <div class="col-md-4 spec-box">
                    <h3>Technische Gegevens</h3>
                    <table class="table table-striped">
                        <tr><th>Vermogen kW (PK)</th><td><?php echo isset($auto['vermogen']) ? $auto['vermogen'] . ' PK' : 'Onbekend'; ?></td></tr>
                        <tr><th>Transmissie</th><td><?php echo isset($auto['transmissie']) ? $auto['transmissie'] : 'Onbekend'; ?></td></tr>
                        <tr><th>Cilinderinhoud</th><td><?php echo isset($auto['cilinderinhoud']) ? $auto['cilinderinhoud'] . ' cm³' : 'Onbekend'; ?></td></tr>
                        <tr><th>Versnellingen</th><td><?php echo isset($auto['versnellingen']) ? $auto['versnellingen'] : 'Onbekend'; ?></td></tr>
                        <tr><th>Cilinders</th><td><?php echo isset($auto['cilinders']) ? $auto['cilinders'] : 'Onbekend'; ?></td></tr>
                        <tr><th>Leeggewicht</th><td><?php echo isset($auto['leeggewicht']) ? $auto['leeggewicht'] . ' kg' : 'Onbekend'; ?></td></tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

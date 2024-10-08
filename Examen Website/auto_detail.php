<?php
session_start();
include 'config.php'; // Zorg voor een correcte verbinding

// Foutopsporing inschakelen
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Controleer of er een id is doorgegeven
if (isset($_GET['id'])) {
    $auto_id = intval($_GET['id']); // Converteer naar een integer om SQL-injectie te voorkomen

    // Haal de auto-gegevens op uit de database
    $query = "SELECT * FROM cars WHERE id = $auto_id";
    $result = mysqli_query($conn, $query);

    // Controleer of de auto bestaat
    if (mysqli_num_rows($result) > 0) {
        $auto = mysqli_fetch_assoc($result); // Haal de auto-informatie op
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
    <link rel="stylesheet" href="css/auto_detail.css"> <!-- Vergeet niet de juiste CSS op te nemen -->
</head>
<body>

<!-- Banner -->
<div class="banner">
    <h1><?php echo $auto['merk'] . " " . $auto['model']; ?></h1>
</div>

<!-- Auto Details -->
<div class="auto-detail-container">
    <h2><?php echo $auto['merk'] . " " . $auto['model']; ?></h2>
    <p>Bouwjaar: <?php echo $auto['bouwjaar']; ?></p>
    <p>Prijs: €<?php echo number_format($auto['prijs'], 2, ',', '.'); ?></p>
    <p>Beschrijving: <?php echo $auto['beschrijving']; ?></p>

    <!-- Extra foto's -->
    <div class="auto-fotos">
        <h3>Bekijk meer foto's:</h3>
        <img src="uploads/<?php echo $auto['afbeelding']; ?>" alt="Foto van <?php echo $auto['merk']; ?>">
        <!-- Voeg meer foto's toe indien beschikbaar -->
    </div>

    <!-- Contact en Reserveren -->
    <div class="auto-contact">
        <h3>Interesse? Neem contact met ons op of reserveer de auto!</h3>
        <form action="reserveren.php" method="POST">
            <input type="hidden" name="auto_id" value="<?php echo $auto['id']; ?>">
            <label for="naam">Naam:</label>
            <input type="text" id="naam" name="naam" required>

            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" required>

            <label for="bericht">Bericht:</label>
            <textarea id="bericht" name="bericht" rows="5" required></textarea>

            <button type="submit">Reserveer deze auto</button>
        </form>
    </div>
</div>

</body>
</html>

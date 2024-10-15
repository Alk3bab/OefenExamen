<?php
session_start();
include 'config.php'; // Zorg voor een correcte databaseverbinding

// Controleer of de ID van de auto is meegegeven
if (!isset($_GET['id']) || empty($_GET['id'])) {
    $error_message = "Geen auto geselecteerd.";
} else {
    $auto_id = (int)$_GET['id'];

    // Haal de autogegevens op uit de database
    $query = "SELECT * FROM cars WHERE id = $auto_id";
    $result = mysqli_query($conn, $query);
    $auto = mysqli_fetch_assoc($result);

    // Controleer of de auto bestaat
    if (!$auto) {
        $error_message = "Auto niet gevonden.";
    }
}

// Verwerk het reserveringsformulier
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $naam = mysqli_real_escape_string($conn, $_POST['naam']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $telefoon = mysqli_real_escape_string($conn, $_POST['telefoon']);
    $opmerkingen = mysqli_real_escape_string($conn, $_POST['opmerkingen']);

    // Voeg de reservering toe aan de database
    $reserveringQuery = "INSERT INTO reserveringen (auto_id, naam, email, telefoon, opmerkingen) VALUES ('$auto_id', '$naam', '$email', '$telefoon', '$opmerkingen')";
    $reserveringResult = mysqli_query($conn, $reserveringQuery);

    if ($reserveringResult) {
        $success_message = "Reservering succesvol! We zullen spoedig contact met je opnemen.";
    } else {
        $error_message = "Er is iets fout gegaan. Probeer het opnieuw.";
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reserveren - PremiumWagens</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .navbar {
            background-color: #212529;
            padding: 15px;
        }

        .navbar .logo a {
            color: white;
            font-size: 24px;
            font-weight: bold;
            text-decoration: none;
        }

        .navbar .nav-links {
            list-style: none;
            display: flex;
            gap: 20px;
        }

        .navbar .nav-links li a {
            color: white;
            text-decoration: none;
            font-size: 18px;
        }

        .navbar .nav-links li a:hover {
            color: #f39c12;
        }

        .form-container {
            margin-top: 50px;
            background-color: #f8f9fa;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .alert {
            margin-top: 20px;
        }

        .btn-terug {
            margin-top: 20px;
        }
    </style>
</head>
<body>

<!-- Navigatiebalk -->
<nav class="navbar">
    <div class="container">
        <div class="logo">
            <a href="index.php">PremiumWagens</a>
        </div>
        <ul class="nav-links">
            <li><a href="index.php">Zoeken</a></li>
            <li><a href="verkoop.php">Verkopen</a></li>
            <li><a href="auto_informatie.php">Auto informatie</a></li>
            <li><a href="login.php">Inloggen</a></li>
        </ul>
    </div>
</nav>

<div class="container">
    <!-- Controleer of er een foutmelding is -->
    <?php if (isset($error_message)) : ?>
        <div class="alert alert-danger">
            <?php echo $error_message; ?>
        </div>
    <?php endif; ?>

    <!-- Controleer of er een succesmelding is -->
    <?php if (isset($success_message)) : ?>
        <div class="alert alert-success">
            <?php echo $success_message; ?>
        </div>
    <?php endif; ?>

    <!-- Formulier voor het reserveren -->
    <?php if (isset($auto)) : ?>
    <div class="form-container">
        <h1>Reserveren: <?php echo htmlspecialchars($auto['merk']) . " " . htmlspecialchars($auto['model']); ?></h1>
        <p>Prijs: €<?php echo number_format($auto['prijs'], 2, ',', '.'); ?></p>

        <form method="POST" action="">
            <div class="mb-3">
                <label for="naam" class="form-label">Naam</label>
                <input type="text" class="form-control" id="naam" name="naam" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <div class="mb-3">
                <label for="telefoon" class="form-label">Telefoonnummer</label>
                <input type="text" class="form-control" id="telefoon" name="telefoon" required>
            </div>

            <div class="mb-3">
                <label for="opmerkingen" class="form-label">Opmerkingen (optioneel)</label>
                <textarea class="form-control" id="opmerkingen" name="opmerkingen" rows="3"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Reserveren</button>
        </form>

        <!-- Terug knop -->
        <a href="javascript:history.back()" class="btn btn-secondary btn-terug">Terug</a>
    </div>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
session_start();
include 'config.php'; // Zorg ervoor dat je de juiste databaseverbinding hebt

// Controleer of de gebruiker is ingelogd en of het een klant is
if (!isset($_SESSION['user']) || $_SESSION['rol'] != 'klant') {
    header('Location: login.php'); // Stuur terug naar login als de gebruiker niet ingelogd is of geen klant is
    exit();
}

$email = $_SESSION['email'];

// Haal de gegevens van de ingelogde klant op
$query = "SELECT * FROM users WHERE email = '$email'";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Klant Dashboard - PremiumWagens</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script>
        // Functie om klantgegevens te tonen en de welkomsttekst te verbergen
        function showGegevens() {
            document.getElementById("welkom").style.display = "none"; // Verberg de welkomsttekst
            document.getElementById("klant-gegevens").style.display = "block"; // Toon de klantgegevens
            document.getElementById("auto-toevoegen").style.display = "none"; // Verberg het auto toevoegen formulier
        }

        // Functie om het auto toe te voegen formulier te tonen en klantgegevens te verbergen
        function showAutoToevoegen() {
            document.getElementById("welkom").style.display = "none"; // Verberg de welkomsttekst
            document.getElementById("auto-toevoegen").style.display = "block"; // Toon het formulier voor auto toevoegen
            document.getElementById("klant-gegevens").style.display = "none"; // Verberg de klantgegevens
        }
    </script>
</head>
<body>

    <div class="d-flex">
        <!-- Sidebar -->
        <nav class="bg-dark text-light p-3" style="width: 250px; min-height: 100vh;">
            <h2 class="text-center">Klant Dashboard</h2>
            <ul class="nav flex-column">
                <li class="nav-item mb-3">
                    <a href="#" onclick="showGegevens()" class="nav-link text-light bg-secondary rounded">Mijn Gegevens</a>
                </li>
                <li class="nav-item mb-3">
                    <a href="#" onclick="showAutoToevoegen()" class="nav-link text-light bg-secondary rounded">Auto Toevoegen</a>
                </li>
            </ul>
            <div class="mt-auto">
                <a href="logout.php" class="btn btn-primary w-100">Uitloggen</a>
            </div>
        </nav>

        <!-- Main content -->
        <div class="p-4 w-100 bg-light">
            <!-- Welkomsttekst, standaard zichtbaar -->
            <div id="welkom">
                <h2>Welkom, <?php echo $user['naam']; ?></h2>
                <p>Klik op "Mijn Gegevens" om je persoonlijke gegevens te bekijken of op "Auto Toevoegen" om een auto te verkopen.</p>
            </div>

            <!-- Klantgegevens, standaard verborgen -->
            <div id="klant-gegevens" style="display: none;">
                <h2>Mijn Gegevens</h2>
                <table class="table table-striped">
                    <tr>
                        <th>Naam:</th>
                        <td><?php echo $user['naam']; ?></td>
                    </tr>
                    <tr>
                        <th>Email:</th>
                        <td><?php echo $user['email']; ?></td>
                    </tr>
                    <tr>
                        <th>Aangemaakt op:</th>
                        <td><?php echo $user['created_at']; ?></td>
                    </tr>
                </table>
            </div>

            <!-- Auto toevoegen formulier, standaard verborgen -->
            <div id="auto-toevoegen" style="display: none;">
                <h2>Auto Toevoegen</h2>
                <form action="process_upload.php" method="POST">
                    <div class="mb-3">
                        <label for="merk" class="form-label">Merk:</label>
                        <input type="text" name="merk" id="merk" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="model" class="form-label">Model:</label>
                        <input type="text" name="model" id="model" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="bouwjaar" class="form-label">Bouwjaar:</label>
                        <input type="number" name="bouwjaar" id="bouwjaar" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="prijs" class="form-label">Prijs:</label>
                        <input type="number" name="prijs" id="prijs" class="form-control" required>
                    </div>

                    <h3>Basisgegevens</h3>

                    <div class="mb-3">
                        <label for="carrosserietype" class="form-label">Carrosserietype:</label>
                        <input type="text" name="carrosserietype" id="carrosserietype" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="categorie" class="form-label">Categorie:</label>
                        <input type="text" name="categorie" id="categorie" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="aandrijving" class="form-label">Aandrijving:</label>
                        <input type="text" name="aandrijving" id="aandrijving" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="stoelen" class="form-label">Stoelen:</label>
                        <input type="number" name="stoelen" id="stoelen" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="deuren" class="form-label">Deuren:</label>
                        <input type="number" name="deuren" id="deuren" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="afbeelding_url" class="form-label">Afbeelding URL:</label>
                        <input type="text" name="afbeelding_url" id="afbeelding_url" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Auto Toevoegen</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

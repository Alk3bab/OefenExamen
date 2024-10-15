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
    <link rel="stylesheet" href="css/klant.css"> 
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

    <div class="admin-container">
        <!-- Zijbalk met menu -->
        <nav class="sidebar">
            <h2>Klant Dashboard</h2>
            <ul>
                <li><a href="#" onclick="showGegevens()">Mijn Gegevens</a></li>
                <li><a href="#" onclick="showAutoToevoegen()">Auto Toevoegen</a></li>
            </ul>
            <div class="sidebar-footer">
                <a href="logout.php" class="btn-back">Uitloggen</a>
            </div>
        </nav>

        <!-- Hoofdinhoud -->
        <div class="main-content">
            <!-- Welkomsttekst, standaard zichtbaar -->
            <div id="welkom">
                <h2>Welkom, <?php echo $user['naam']; ?></h2>
                <p>Klik op "Mijn Gegevens" om je persoonlijke gegevens te bekijken of op "Auto Toevoegen" om een auto te verkopen.</p>
            </div>

            <!-- Klantgegevens, standaard verborgen -->
            <div id="klant-gegevens" style="display: none;">
                <h2>Mijn Gegevens</h2>
                <table>
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
                    <label for="merk">Merk:</label>
                    <input type="text" name="merk" id="merk" required>

                    <label for="model">Model:</label>
                    <input type="text" name="model" id="model" required>

                    <label for="bouwjaar">Bouwjaar:</label>
                    <input type="number" name="bouwjaar" id="bouwjaar" required>

                    <label for="prijs">Prijs:</label>
                    <input type="number" name="prijs" id="prijs" required>

                    <h3>Basisgegevens</h3>

                    <label for="carrosserietype">Carrosserietype:</label>
                    <input type="text" name="carrosserietype" id="carrosserietype" required>

                    <label for="categorie">Categorie:</label>
                    <input type="text" name="categorie" id="categorie" required>

                    <label for="aandrijving">Aandrijving:</label>
                    <input type="text" name="aandrijving" id="aandrijving" required>

                    <label for="stoelen">Stoelen:</label>
                    <input type="number" name="stoelen" id="stoelen" required>

                    <label for="deuren">Deuren:</label>
                    <input type="number" name="deuren" id="deuren" required>

                    <label for="afbeelding_url">Afbeelding URL:</label>
                    <input type="text" name="afbeelding_url" id="afbeelding_url" required>

                    <button type="submit">Auto Toevoegen</button>
                </form>
            </div>

        </div>
    </div>

</body>
</html>

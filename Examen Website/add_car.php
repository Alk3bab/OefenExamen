<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auto Toevoegen - PremiumWagens</title>
    <link rel="stylesheet" href="css/admin.css"> <!-- Zorg dat het pad naar je CSS-bestand klopt -->
</head>

<?php
session_start();
include 'config.php'; // Verbind met de database

// Controleer of het formulier correct is verzonden
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Debugging: toon alle POST-gegevens
    echo "<pre>";
    print_r($_POST); // Toon alle formulierwaarden
    echo "</pre>";

    // Haal de waarden uit het formulier op en valideer ze
    $merk = isset($_POST['merk']) ? mysqli_real_escape_string($conn, $_POST['merk']) : null;
    $model = isset($_POST['model']) ? mysqli_real_escape_string($conn, $_POST['model']) : null;
    $bouwjaar = isset($_POST['bouwjaar']) ? (int) $_POST['bouwjaar'] : null;
    $prijs = isset($_POST['prijs']) ? (float) $_POST['prijs'] : null;
    $beschrijving = isset($_POST['beschrijving']) ? mysqli_real_escape_string($conn, $_POST['beschrijving']) : null;
    $afbeelding_url = isset($_POST['afbeelding_url']) ? mysqli_real_escape_string($conn, $_POST['afbeelding_url']) : null;

    // Controleer of alle vereiste velden zijn ingevuld
    if ($merk && $model && $bouwjaar && $prijs && $beschrijving && $afbeelding_url) {
        // Debugging: toon de SQL-query die zal worden uitgevoerd
        $query = "INSERT INTO cars (merk, model, bouwjaar, prijs, afbeelding_url, beschrijving) 
                  VALUES ('$merk', '$model', '$bouwjaar', '$prijs', '$afbeelding_url', '$beschrijving')";
        
        echo "<p>SQL-query: $query</p>"; // Toon de query voor debugging

        // Voer de query uit en controleer of deze slaagt
        if (mysqli_query($conn, $query)) {
            // Bevestigingsbericht met stijl en terugknop
            echo "
            <div class='success-message'>
                <h2>Auto succesvol toegevoegd!</h2>
                <p>De auto <strong>$merk $model</strong> is succesvol aan de database toegevoegd.</p>
                <a href='admin.php' class='btn-back'>Terug naar het Admin Panel</a>
            </div>
            ";
        } else {
            // Toon een foutmelding met informatie over de queryfout
            echo "Er is een fout opgetreden bij het toevoegen van de auto: " . mysqli_error($conn);
        }
    } else {
        // Toon een foutmelding als verplichte velden ontbreken
        echo "<p style='color: red;'>Vul alle verplichte velden in.</p>";
    }
}
?>

<!-- Formulier voor het toevoegen van een auto -->
<form action="add_car.php" method="POST">
    <label for="merk">Merk:</label>
    <input type="text" name="merk" required><br>

    <label for="model">Model:</label>
    <input type="text" name="model" required><br>

    <label for="bouwjaar">Bouwjaar:</label>
    <input type="number" name="bouwjaar" required><br>

    <label for="prijs">Prijs:</label>
    <input type="text" name="prijs" required><br>

    <label for="beschrijving">Beschrijving:</label>
    <textarea name="beschrijving" required></textarea><br>

    <!-- Afbeelding URL invoerveld -->
    <label for="afbeelding_url">Afbeelding URL:</label>
    <input type="text" name="afbeelding_url" placeholder="Voer de URL van de afbeelding in" required><br>

    <button type="submit">Auto Toevoegen</button>
</form>

</html>

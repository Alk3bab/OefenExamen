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
    // Haal de waarden uit het formulier op en valideer ze
    $merk = isset($_POST['merk']) ? mysqli_real_escape_string($conn, $_POST['merk']) : null;
    $model = isset($_POST['model']) ? mysqli_real_escape_string($conn, $_POST['model']) : null;
    $bouwjaar = isset($_POST['bouwjaar']) ? (int) $_POST['bouwjaar'] : null;
    $prijs = isset($_POST['prijs']) ? (float) $_POST['prijs'] : null;
    $beschrijving = isset($_POST['beschrijving']) ? mysqli_real_escape_string($conn, $_POST['beschrijving']) : null;

    // Nieuwe velden voor uitgebreide auto-informatie
    $carrosserietype = isset($_POST['carrosserietype']) ? mysqli_real_escape_string($conn, $_POST['carrosserietype']) : null;
    $categorie = isset($_POST['categorie']) ? mysqli_real_escape_string($conn, $_POST['categorie']) : null;
    $aandrijving = isset($_POST['aandrijving']) ? mysqli_real_escape_string($conn, $_POST['aandrijving']) : null;
    $stoelen = isset($_POST['stoelen']) ? (int) $_POST['stoelen'] : null;
    $deuren = isset($_POST['deuren']) ? (int) $_POST['deuren'] : null;
    $advertentienr = isset($_POST['advertentienr']) ? mysqli_real_escape_string($conn, $_POST['advertentienr']) : null;
    $kilometerstand = isset($_POST['kilometerstand']) ? mysqli_real_escape_string($conn, $_POST['kilometerstand']) : null;
    $apk = isset($_POST['apk']) ? mysqli_real_escape_string($conn, $_POST['apk']) : null;
    $vermogen_kw = isset($_POST['vermogen_kw']) ? mysqli_real_escape_string($conn, $_POST['vermogen_kw']) : null;
    $transmissie = isset($_POST['transmissie']) ? mysqli_real_escape_string($conn, $_POST['transmissie']) : null;
    $cilinderinhoud = isset($_POST['cilinderinhoud']) ? mysqli_real_escape_string($conn, $_POST['cilinderinhoud']) : null;
    $versnellingen = isset($_POST['versnellingen']) ? mysqli_real_escape_string($conn, $_POST['versnellingen']) : null;
    $cilinders = isset($_POST['cilinders']) ? mysqli_real_escape_string($conn, $_POST['cilinders']) : null;
    $leeggewicht = isset($_POST['leeggewicht']) ? mysqli_real_escape_string($conn, $_POST['leeggewicht']) : null;

    // Haal de hoofdafbeelding en array van extra afbeelding-URLs op
    $hoofdfoto_url = isset($_POST['hoofdfoto_url']) ? mysqli_real_escape_string($conn, $_POST['hoofdfoto_url']) : null;
    $afbeelding_urls = isset($_POST['afbeelding_urls']) ? $_POST['afbeelding_urls'] : [];

    // Controleer of alle vereiste velden zijn ingevuld
    if ($merk && $model && $bouwjaar && $prijs && $beschrijving && $hoofdfoto_url) {
        // Voeg de auto toe aan de 'cars' tabel met de uitgebreide informatie
        $query = "INSERT INTO cars (merk, model, bouwjaar, prijs, afbeelding_url, beschrijving, carrosserietype, categorie, aandrijving, stoelen, deuren, advertentienr, kilometerstand, apk, vermogen_kw, transmissie, cilinderinhoud, versnellingen, cilinders, leeggewicht) 
                  VALUES ('$merk', '$model', '$bouwjaar', '$prijs', '$hoofdfoto_url', '$beschrijving', '$carrosserietype', '$categorie', '$aandrijving', '$stoelen', '$deuren', '$advertentienr', '$kilometerstand', '$apk', '$vermogen_kw', '$transmissie', '$cilinderinhoud', '$versnellingen', '$cilinders', '$leeggewicht')";
        
        if (mysqli_query($conn, $query)) {
            // Haal het laatst ingevoegde auto-ID op
            $car_id = mysqli_insert_id($conn);

            // Voeg elke extra afbeelding-URL toe aan de 'car_images' tabel
            foreach ($afbeelding_urls as $url) {
                if (!empty($url)) {
                    $query_image = "INSERT INTO car_images (car_id, image_url) VALUES ('$car_id', '$url')";
                    mysqli_query($conn, $query_image);
                }
            }

            // Bevestigingsbericht
            echo "
            <div class='success-message'>
                <h2>Auto succesvol toegevoegd!</h2>
                <p>De auto <strong>$merk $model</strong> is succesvol aan de database toegevoegd.</p>
                <a href='admin.php' class='btn-back'>Terug naar het Admin Panel</a>
            </div>
            ";
        } else {
            echo "Er is een fout opgetreden bij het toevoegen van de auto: " . mysqli_error($conn);
        }
    } else {
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

    <!-- Extra velden voor uitgebreide auto-informatie -->
    <h3>Basisgegevens</h3>
    <label for="carrosserietype">Carrosserietype:</label>
    <input type="text" name="carrosserietype"><br>

    <label for="categorie">Categorie:</label>
    <input type="text" name="categorie"><br>

    <label for="aandrijving">Aandrijving:</label>
    <input type="text" name="aandrijving"><br>

    <label for="stoelen">Stoelen:</label>
    <input type="number" name="stoelen"><br>

    <label for="deuren">Deuren:</label>
    <input type="number" name="deuren"><br>

    <label for="advertentienr">Advertentienr:</label>
    <input type="text" name="advertentienr"><br>

    <h3>Voertuiggeschiedenis</h3>
    <label for="kilometerstand">Kilometerstand:</label>
    <input type="text" name="kilometerstand"><br>

    <label for="apk">APK:</label>
    <input type="text" name="apk"><br>

    <h3>Technische Gegevens</h3>
    <label for="vermogen_kw">Vermogen kW (PK):</label>
    <input type="text" name="vermogen_kw"><br>

    <label for="transmissie">Transmissie:</label>
    <input type="text" name="transmissie"><br>

    <label for="cilinderinhoud">Cilinderinhoud:</label>
    <input type="text" name="cilinderinhoud"><br>

    <label for="versnellingen">Versnellingen:</label>
    <input type="text" name="versnellingen"><br>

    <label for="cilinders">Cilinders:</label>
    <input type="text" name="cilinders"><br>

    <label for="leeggewicht">Leeggewicht:</label>
    <input type="text" name="leeggewicht"><br>

    <!-- Hoofdafbeelding URL invoerveld -->
    <label for="hoofdfoto_url">Hoofdafbeelding URL:</label>
    <input type="text" name="hoofdfoto_url" placeholder="Voer de URL van de hoofdfoto in" required><br>

    <!-- Invoervelden voor meerdere extra afbeelding-URLs -->
    <label for="afbeelding_urls[]">Extra Afbeelding URL's:</label>
    <input type="text" name="afbeelding_urls[]" placeholder="Voer de URL van de extra afbeelding in" class="form-control">
    <input type="text" name="afbeelding_urls[]" placeholder="Voer de URL van de extra afbeelding in" class="form-control">
    <input type="text" name="afbeelding_urls[]" placeholder="Voer de URL van de extra afbeelding in" class="form-control"><br>

    <button type="submit">Auto Toevoegen</button>
</form>

</html>

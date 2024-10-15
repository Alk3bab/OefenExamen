<?php

session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'config.php'; // Verbind met de database

// Controleer of de gebruiker is ingelogd en een admin is
if (!isset($_SESSION['user']) || $_SESSION['rol'] != 'admin') {
    header('Location: login.php');
    exit();
}

// Verwerk het formulier om een auto toe te voegen
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Haal de waarden uit het formulier op en valideer ze
    $merk = mysqli_real_escape_string($conn, $_POST['merk'] ?? '');
    $model = mysqli_real_escape_string($conn, $_POST['model'] ?? '');
    $bouwjaar = (int)($_POST['bouwjaar'] ?? 0);
    $prijs = (float)($_POST['prijs'] ?? 0);
    $beschrijving = mysqli_real_escape_string($conn, $_POST['beschrijving'] ?? '');
    $hoofdfoto_url = mysqli_real_escape_string($conn, $_POST['hoofdfoto_url'] ?? '');

    // Haal de overige velden op
    $carrosserietype = mysqli_real_escape_string($conn, $_POST['carrosserietype'] ?? '');
    $categorie = mysqli_real_escape_string($conn, $_POST['categorie'] ?? '');
    $aandrijving = mysqli_real_escape_string($conn, $_POST['aandrijving'] ?? '');
    $stoelen = (int)($_POST['stoelen'] ?? 0);
    $deuren = (int)($_POST['deuren'] ?? 0);
    $advertentienr = mysqli_real_escape_string($conn, $_POST['advertentienr'] ?? '');
    $kilometerstand = mysqli_real_escape_string($conn, $_POST['kilometerstand'] ?? '');
    $apk = mysqli_real_escape_string($conn, $_POST['apk'] ?? '');
    $vermogen_kw = mysqli_real_escape_string($conn, $_POST['vermogen_kw'] ?? '');
    $transmissie = mysqli_real_escape_string($conn, $_POST['transmissie'] ?? '');
    $cilinderinhoud = mysqli_real_escape_string($conn, $_POST['cilinderinhoud'] ?? '');
    $versnellingen = mysqli_real_escape_string($conn, $_POST['versnellingen'] ?? '');
    $cilinders = mysqli_real_escape_string($conn, $_POST['cilinders'] ?? '');
    $leeggewicht = mysqli_real_escape_string($conn, $_POST['leeggewicht'] ?? '');

    $afbeelding_urls = $_POST['afbeelding_urls'] ?? [];

    // Voeg de auto toe aan de 'cars' tabel
    $query = "INSERT INTO cars (merk, model, bouwjaar, prijs, beschrijving, afbeelding_url, carrosserietype, categorie, aandrijving, stoelen, deuren, advertentienr, kilometerstand, apk, vermogen_kw, transmissie, cilinderinhoud, versnellingen, cilinders, leeggewicht)
              VALUES ('$merk', '$model', '$bouwjaar', '$prijs', '$beschrijving', '$hoofdfoto_url', '$carrosserietype', '$categorie', '$aandrijving', '$stoelen', '$deuren', '$advertentienr', '$kilometerstand', '$apk', '$vermogen_kw', '$transmissie', '$cilinderinhoud', '$versnellingen', '$cilinders', '$leeggewicht')";
    
    if (mysqli_query($conn, $query)) {
        $car_id = mysqli_insert_id($conn);

        // Voeg de extra afbeeldingen toe aan de 'car_images' tabel
        foreach ($afbeelding_urls as $url) {
            if (!empty($url)) {
                $query_image = "INSERT INTO car_images (car_id, image_url) VALUES ('$car_id', '$url')";
                mysqli_query($conn, $query_image);
            }
        }
        echo "<p style='color:green;'>Auto succesvol toegevoegd!</p>";
    } else {
        echo "<p style='color:red;'>Er is een fout opgetreden: " . mysqli_error($conn) . "</p>";
    }
}

// Haal klantgegevens en auto's op uit de database
$klanten_query = "SELECT * FROM users WHERE rol='klant'";
$klanten_result = mysqli_query($conn, $klanten_query);

$autos_query = "SELECT * FROM cars ORDER BY created_at DESC";
$autos_result = mysqli_query($conn, $autos_query);
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - PremiumWagens</title>
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>

    <div class="admin-container">
        <!-- Zijbalk met menu -->
        <nav class="sidebar">
            <h2>Admin Dashboard</h2>
            <ul>
                <li><a href="#" id="klanten-link">Klantgegevens</a></li>
                <li><a href="#" id="autos-link">Auto's Toevoegen</a></li>
                <li><a href="#" id="overzicht-link">Auto Overzicht</a></li>
            </ul>
            <div class="sidebar-footer">
                <a href="login.php" class="btn-back">Terug</a>
            </div>
        </nav>

        <!-- Hoofdinhoud -->
        <div class="main-content" id="main-content">
            <h2>Welkom, Admin!</h2>
            <p>Kies een optie uit het menu om te beginnen.</p>
        </div>
    </div>

    <script>
        // Klantgegevens weergeven
        document.getElementById('klanten-link').addEventListener('click', function() {
            document.getElementById('main-content').innerHTML = `
                <h2>Klantgegevens</h2>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Naam</th>
                            <th>Email</th>
                            <th>Aangemaakt op</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($klant = mysqli_fetch_assoc($klanten_result)) { ?>
                        <tr>
                            <td><?php echo $klant['id']; ?></td>
                            <td><?php echo $klant['naam']; ?></td>
                            <td><?php echo $klant['email']; ?></td>
                            <td><?php echo $klant['created_at']; ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            `;
        });

        // Auto's toevoegen weergeven
        document.getElementById('autos-link').addEventListener('click', function() {
            document.getElementById('main-content').innerHTML = `
                <h2>Auto Toevoegen</h2>
                <form method="POST" action="">
                    <div class="form-group">
                        <label for="merk">Merk</label>
                        <input type="text" name="merk" required class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="model">Model</label>
                        <input type="text" name="model" required class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="bouwjaar">Bouwjaar</label>
                        <input type="number" name="bouwjaar" required class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="prijs">Prijs</label>
                        <input type="text" name="prijs" required class="form-control">
                    </div>

                    <!-- Basisgegevens -->
                    <h3>Basisgegevens</h3>
                    <div class="form-group">
                        <label for="carrosserietype">Carrosserietype</label>
                        <input type="text" name="carrosserietype" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="categorie">Categorie</label>
                        <input type="text" name="categorie" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="aandrijving">Aandrijving</label>
                        <input type="text" name="aandrijving" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="stoelen">Stoelen</label>
                        <input type="number" name="stoelen" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="deuren">Deuren</label>
                        <input type="number" name="deuren" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="advertentienr">Advertentienr</label>
                        <input type="text" name="advertentienr" class="form-control">
                    </div>

                    <!-- Voertuiggeschiedenis -->
                    <h3>Voertuiggeschiedenis</h3>
                    <div class="form-group">
                        <label for="kilometerstand">Kilometerstand</label>
                        <input type="text" name="kilometerstand" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="apk">APK</label>
                        <input type="text" name="apk" class="form-control">
                    </div>

                    <!-- Technische gegevens -->
                    <h3>Technische Gegevens</h3>
                    <div class="form-group">
                        <label for="vermogen_kw">Vermogen kW (PK)</label>
                        <input type="text" name="vermogen_kw" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="transmissie">Transmissie</label>
                        <input type="text" name="transmissie" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="cilinderinhoud">Cilinderinhoud</label>
                        <input type="text" name="cilinderinhoud" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="versnellingen">Versnellingen</label>
                        <input type="text" name="versnellingen" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="cilinders">Cilinders</label>
                        <input type="text" name="cilinders" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="leeggewicht">Leeggewicht</label>
                        <input type="text" name="leeggewicht" class="form-control">
                    </div>

                    <!-- Invoervelden voor hoofdfoto en extra afbeeldingen -->
                    <div class="form-group">
                        <label for="hoofdfoto_url">Hoofdafbeelding URL</label>
                        <input type="text" name="hoofdfoto_url" placeholder="Voer de URL van de hoofdfoto in" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="afbeelding_urls[]">Extra Afbeelding URL's</label>
                        <input type="text" name="afbeelding_urls[]" placeholder="Voer de URL van de extra afbeelding in" class="form-control">
                        <input type="text" name="afbeelding_urls[]" placeholder="Voer de URL van de extra afbeelding in" class="form-control">
                        <input type="text" name="afbeelding_urls[]" placeholder="Voer de URL van de extra afbeelding in" class="form-control">
                    </div>

                    <button type="submit" class="btn btn-primary">Auto Toevoegen</button>
                </form>
            `;
        });

        // Auto Overzicht weergeven
        document.getElementById('overzicht-link').addEventListener('click', function() {
            document.getElementById('main-content').innerHTML = `
                <h2>Auto Overzicht</h2>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Merk</th>
                            <th>Model</th>
                            <th>Bouwjaar</th>
                            <th>Prijs</th>
                            <th>Afbeelding</th> <!-- Voor het weergeven van de hoofdfoto -->
                            <th>Aangemaakt op</th>
                            <th>Acties</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($auto = mysqli_fetch_assoc($autos_result)) { ?>
                        <tr>
                            <td><?php echo $auto['id']; ?></td>
                            <td><?php echo $auto['merk']; ?></td>
                            <td><?php echo $auto['model']; ?></td>
                            <td><?php echo $auto['bouwjaar']; ?></td>
                            <td>€<?php echo $auto['prijs']; ?></td>
                            <td><img src="<?php echo $auto['afbeelding_url']; ?>" alt="<?php echo $auto['model']; ?>" style="width:100px;"></td>
                            <td><?php echo $auto['created_at']; ?></td>
                            <td>
                                <a href="edit_car.php?id=<?php echo $auto['id']; ?>" class="btn-edit">Bewerken</a>
                                <a href="delete_car.php?id=<?php echo $auto['id']; ?>" class="btn-delete" onclick="return confirm('Weet je zeker dat je deze auto wilt verwijderen?');">Verwijderen</a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            `;
        });
    </script>

</body>
</html>

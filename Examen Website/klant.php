<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'config.php'; // Verbind met de database

// Controleer of de gebruiker is ingelogd en een klant is
if (!isset($_SESSION['user']) || $_SESSION['rol'] != 'klant') {
    header('Location: login.php');
    exit();
}

// Haal klantgegevens op
$email = $_SESSION['email'];
$query = "SELECT * FROM users WHERE email = '$email'";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);

// Functie om auto's toe te voegen
$success_message = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['auto_toevoegen'])) {
    // Haal de waarden uit het formulier op en valideer ze
    $merk = mysqli_real_escape_string($conn, $_POST['merk']);
    $model = mysqli_real_escape_string($conn, $_POST['model']);
    $bouwjaar = (int) $_POST['bouwjaar'];
    $prijs = (float) $_POST['prijs'];
    $beschrijving = mysqli_real_escape_string($conn, $_POST['beschrijving']);
    $carrosserietype = mysqli_real_escape_string($conn, $_POST['carrosserietype']);
    $categorie = mysqli_real_escape_string($conn, $_POST['categorie']);
    $aandrijving = mysqli_real_escape_string($conn, $_POST['aandrijving']);
    $stoelen = (int) $_POST['stoelen'];
    $deuren = (int) $_POST['deuren'];
    $advertentienr = mysqli_real_escape_string($conn, $_POST['advertentienr']);
    $kilometerstand = mysqli_real_escape_string($conn, $_POST['kilometerstand']);
    $apk = mysqli_real_escape_string($conn, $_POST['apk']);
    $vermogen_kw = mysqli_real_escape_string($conn, $_POST['vermogen_kw']);
    $transmissie = mysqli_real_escape_string($conn, $_POST['transmissie']);
    $cilinderinhoud = mysqli_real_escape_string($conn, $_POST['cilinderinhoud']);
    $versnellingen = mysqli_real_escape_string($conn, $_POST['versnellingen']);
    $cilinders = mysqli_real_escape_string($conn, $_POST['cilinders']);
    $leeggewicht = mysqli_real_escape_string($conn, $_POST['leeggewicht']);
    $hoofdfoto_url = mysqli_real_escape_string($conn, $_POST['hoofdfoto_url']);
    $afbeelding_urls = isset($_POST['afbeelding_urls']) ? $_POST['afbeelding_urls'] : [];

    // Voeg de auto toe aan de database met is_approved = 0
    $query = "INSERT INTO cars (merk, model, bouwjaar, prijs, afbeelding_url, beschrijving, carrosserietype, categorie, aandrijving, stoelen, deuren, advertentienr, kilometerstand, apk, vermogen_kw, transmissie, cilinderinhoud, versnellingen, cilinders, leeggewicht, is_approved) 
              VALUES ('$merk', '$model', '$bouwjaar', '$prijs', '$hoofdfoto_url', '$beschrijving', '$carrosserietype', '$categorie', '$aandrijving', '$stoelen', '$deuren', '$advertentienr', '$kilometerstand', '$apk', '$vermogen_kw', '$transmissie', '$cilinderinhoud', '$versnellingen', '$cilinders', '$leeggewicht', 0)";
    
    if (mysqli_query($conn, $query)) {
        $car_id = mysqli_insert_id($conn);
        foreach ($afbeelding_urls as $url) {
            if (!empty($url)) {
                $query_image = "INSERT INTO car_images (car_id, image_url) VALUES ('$car_id', '$url')";
                mysqli_query($conn, $query_image);
            }
        }
        // Het bericht dat wordt weergegeven aan de klant na het succesvol toevoegen van de auto
        $success_message = "Uw advertentie wordt gecontroleerd. U zult binnen 10 minuten een bericht ontvangen.";
    } else {
        echo "Er is een fout opgetreden bij het toevoegen van de auto: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Klant Dashboard - PremiumWagens</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
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
                <a href="#" onclick="showAutoToevoegen()" class="nav-link text-light bg-secondary rounded">Auto Verkopen</a>
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

        <!-- Klantgegevens -->
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

        <!-- Auto toevoegen formulier -->
        <div id="auto-toevoegen" style="display: none;">
            <h2>Auto Toevoegen</h2>
            <?php if (!empty($success_message)) { ?>
                <div id="success-alert" class="alert alert-info">
                    <?php echo $success_message; ?>
                </div>
            <?php } ?>

            <form method="POST" action="">
                <div class="mb-3">
                    <label for="merk" class="form-label">Merk</label>
                    <input type="text" name="merk" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="model" class="form-label">Model</label>
                    <input type="text" name="model" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="bouwjaar" class="form-label">Bouwjaar</label>
                    <input type="number" name="bouwjaar" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="prijs" class="form-label">Prijs</label>
                    <input type="number" name="prijs" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="beschrijving" class="form-label">Beschrijving</label>
                    <textarea name="beschrijving" class="form-control" rows="4"></textarea>
                </div>

                <!-- Auto details -->
                <h3>Auto Details</h3>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="carrosserietype" class="form-label">Carrosserietype</label>
                        <input type="text" name="carrosserietype" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="categorie" class="form-label">Categorie</label>
                        <input type="text" name="categorie" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="aandrijving" class="form-label">Aandrijving</label>
                        <input type="text" name="aandrijving" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="stoelen" class="form-label">Stoelen</label>
                        <input type="number" name="stoelen" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="deuren" class="form-label">Deuren</label>
                        <input type="number" name="deuren" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="advertentienr" class="form-label">Advertentienr</label>
                        <input type="text" name="advertentienr" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="kilometerstand" class="form-label">Kilometerstand</label>
                        <input type="text" name="kilometerstand" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="apk" class="form-label">APK</label>
                        <input type="text" name="apk" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="vermogen_kw" class="form-label">Vermogen kW (PK)</label>
                        <input type="text" name="vermogen_kw" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="transmissie" class="form-label">Transmissie</label>
                        <input type="text" name="transmissie" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="cilinderinhoud" class="form-label">Cilinderinhoud</label>
                        <input type="text" name="cilinderinhoud" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="versnellingen" class="form-label">Versnellingen</label>
                        <input type="text" name="versnellingen" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="cilinders" class="form-label">Cilinders</label>
                        <input type="text" name="cilinders" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="leeggewicht" class="form-label">Leeggewicht</label>
                        <input type="text" name="leeggewicht" class="form-control">
                    </div>
                </div>

                <!-- Hoofd- en extra afbeelding velden -->
                <div class="mb-3">
                    <label for="hoofdfoto_url" class="form-label">Hoofdafbeelding URL</label>
                    <input type="text" name="hoofdfoto_url" class="form-control" placeholder="Voer de URL van de hoofdfoto in" required>
                </div>

                <div id="extra-images-container" class="mb-3">
                    <label for="afbeelding_urls[]" class="form-label">Extra Afbeelding URL's</label>
                    <input type="text" name="afbeelding_urls[]" class="form-control" placeholder="Voer de URL van de extra afbeelding in">
                </div>

                <button type="button" class="btn btn-secondary mb-3" id="add-image-field">Voeg extra afbeelding toe</button>
                <button type="submit" name="auto_toevoegen" class="btn btn-primary w-100">Auto Toevoegen</button>
            </form>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<!-- Script om de succesmelding na 10 seconden te verbergen -->
<script>
    setTimeout(function() {
        var successAlert = document.getElementById('success-alert');
        if (successAlert) {
            successAlert.style.display = 'none';
        }
    }, 10000); // Verberg na 10 seconden

    // Functie om klantgegevens te tonen
    function showGegevens() {
        document.getElementById("welkom").style.display = "none";
        document.getElementById("klant-gegevens").style.display = "block";
        document.getElementById("auto-toevoegen").style.display = "none";
    }

    // Functie om auto toevoegen formulier te tonen
    function showAutoToevoegen() {
        document.getElementById("welkom").style.display = "none";
        document.getElementById("klant-gegevens").style.display = "none";
        document.getElementById("auto-toevoegen").style.display = "block";
    }

    // Voeg extra afbeeldingsvelden toe
    document.getElementById('add-image-field').addEventListener('click', function() {
        const container = document.getElementById('extra-images-container');
        const newInput = document.createElement('div');
        newInput.classList.add('mb-3');
        newInput.innerHTML = `
            <input type="text" name="afbeelding_urls[]" class="form-control mt-2" placeholder="Voer de URL van de extra afbeelding in">
        `;
        container.appendChild(newInput);
    });
</script>

</body>
</html>

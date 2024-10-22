<?php
session_start();
include 'config.php'; // Verbind met de database

// Controleer of de gebruiker is ingelogd en een admin is
if (!isset($_SESSION['user']) || $_SESSION['rol'] != 'admin') {
    header('Location: login.php');
    exit();
}

// Haal klantgegevens, auto's en berichten op uit de database
$klanten_query = "SELECT * FROM users WHERE rol='klant'";
$klanten_result = mysqli_query($conn, $klanten_query);

$autos_query = "SELECT * FROM cars ORDER BY created_at DESC";
$autos_result = mysqli_query($conn, $autos_query);

$berichten_query = "SELECT * FROM berichten ORDER BY datum DESC";
$berichten_result = mysqli_query($conn, $berichten_query);

// Auto's goedkeuren of afkeuren
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['car_id'])) {
    $car_id = $_POST['car_id'];
    
    if (isset($_POST['approve'])) {
        $approve_query = "UPDATE cars SET is_approved = 1 WHERE id = $car_id";
        mysqli_query($conn, $approve_query);
    } elseif (isset($_POST['reject'])) {
        $reject_query = "DELETE FROM cars WHERE id = $car_id";
        mysqli_query($conn, $reject_query);
    }
    header('Location: admin.php');
    exit();
}

// Functie om auto's toe te voegen door admin
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

    // Voeg de auto toe aan de database door admin (is_approved = 1)
    $query = "INSERT INTO cars (merk, model, bouwjaar, prijs, afbeelding_url, beschrijving, carrosserietype, categorie, aandrijving, stoelen, deuren, advertentienr, kilometerstand, apk, vermogen_kw, transmissie, cilinderinhoud, versnellingen, cilinders, leeggewicht, is_approved) 
              VALUES ('$merk', '$model', '$bouwjaar', '$prijs', '$hoofdfoto_url', '$beschrijving', '$carrosserietype', '$categorie', '$aandrijving', '$stoelen', '$deuren', '$advertentienr', '$kilometerstand', '$apk', '$vermogen_kw', '$transmissie', '$cilinderinhoud', '$versnellingen', '$cilinders', '$leeggewicht', 1)";
    
    if (mysqli_query($conn, $query)) {
        $car_id = mysqli_insert_id($conn);
        foreach ($afbeelding_urls as $url) {
            if (!empty($url)) {
                $query_image = "INSERT INTO car_images (car_id, image_url) VALUES ('$car_id', '$url')";
                mysqli_query($conn, $query_image);
            }
        }
        $success_message = "Auto succesvol toegevoegd!";
    } else {
        echo "Er is een fout opgetreden bij het toevoegen van de auto: " . mysqli_error($conn);
    }
}

// Functie om e-mails te versturen
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['send_email'])) {
    $to = mysqli_real_escape_string($conn, $_POST['to']);
    $subject = mysqli_real_escape_string($conn, $_POST['subject']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);
    
    $headers = "From: info@premiumwagens.nl";

    if (mail($to, $subject, $message, $headers)) {
        $email_success = true;
    } else {
        $email_success = false;
    }
}

?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="d-flex">
    <!-- Sidebar -->
    <nav class="bg-dark text-light p-3" style="width: 250px; min-height: 100vh;">
        <h2 class="text-center">Admin Dashboard</h2>
        <ul class="nav flex-column">
            <li class="nav-item mb-3">
                <a href="#" id="klanten-link" class="nav-link text-light bg-secondary rounded">Klantgegevens</a>
            </li>
            <li class="nav-item mb-3">
                <a href="#" id="autos-link" class="nav-link text-light bg-secondary rounded">Auto's Toevoegen</a>
            </li>
            <li class="nav-item mb-3">
                <a href="#" id="overzicht-link" class="nav-link text-light bg-secondary rounded">Auto Overzicht</a>
            </li>
            <li class="nav-item mb-3">
                <a href="#" id="approve-link" class="nav-link text-light bg-secondary rounded">Auto's Goedkeuren</a>
            </li>
            <li class="nav-item mb-3">
                <a href="#" id="berichten-link" class="nav-link text-light bg-secondary rounded">Berichten</a>
            </li>
            <li class="nav-item mb-3">
                <a href="#" id="email-link" class="nav-link text-light bg-secondary rounded">Mail Sturen</a>
            </li>
        </ul>
        <div class="mt-auto">
            <a href="login.php" class="btn btn-primary w-100">Terug</a>
        </div>
    </nav>

    <!-- Main content -->
    <div class="p-4 w-100 bg-light" id="main-content">
        <h2>Welkom, Admin!</h2>
        <p>Kies een optie uit het menu om te beginnen.</p>

        <!-- Bevestigingsbericht na het toevoegen van een auto -->
        <?php if (!empty($success_message)) { ?>
            <div class="alert alert-success">
                <?php echo $success_message; ?>
            </div>
        <?php } ?>
    </div>
</div>

<script>
    // Klantgegevens weergeven
    document.getElementById('klanten-link').addEventListener('click', function() {
        document.getElementById('main-content').innerHTML = `
            <h2>Klantgegevens</h2>
            <table class="table table-striped">
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

    // Auto's toevoegen door admin
    document.getElementById('autos-link').addEventListener('click', function() {
        document.getElementById('main-content').innerHTML = `
            <div class="card p-4">
                <h2>Auto Toevoegen</h2>
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

                    <!-- Extra velden voor auto details -->
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

                    <!-- Hoofdafbeelding URL invoerveld -->
                    <div class="mb-3">
                        <label for="hoofdfoto_url" class="form-label">Hoofdafbeelding URL</label>
                        <input type="text" name="hoofdfoto_url" class="form-control" placeholder="Voer de URL van de hoofdfoto in" required>
                    </div>
                    
                    <!-- Invoervelden voor meerdere extra afbeelding-URLs -->
                    <div id="extra-images-container">
                        <div class="mb-3">
                            <label for="afbeelding_urls[]" class="form-label">Extra Afbeelding URL's</label>
                            <input type="text" name="afbeelding_urls[]" class="form-control" placeholder="Voer de URL van de extra afbeelding in">
                        </div>
                    </div>

                    <button type="submit" name="auto_toevoegen" class="btn btn-primary w-100">Auto Toevoegen</button>
                </form>
            </div>
        `;
    });

    // Auto's goedkeuren door admin
    document.getElementById('approve-link').addEventListener('click', function() {
        document.getElementById('main-content').innerHTML = `
            <h2>Te beoordelen auto's</h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Merk</th>
                        <th>Model</th>
                        <th>Bouwjaar</th>
                        <th>Prijs</th>
                        <th>Acties</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $approve_query = "SELECT * FROM cars WHERE is_approved = 0";
                    $approve_result = mysqli_query($conn, $approve_query);
                    while ($auto = mysqli_fetch_assoc($approve_result)) { ?>
                    <tr>
                        <td><?php echo $auto['merk']; ?></td>
                        <td><?php echo $auto['model']; ?></td>
                        <td><?php echo $auto['bouwjaar']; ?></td>
                        <td>€<?php echo $auto['prijs']; ?></td>
                        <td>
                            <form method="POST" style="display:inline-block;">
                                <input type="hidden" name="car_id" value="<?php echo $auto['id']; ?>">
                                <button type="submit" name="approve" class="btn btn-success btn-sm">Goedkeuren</button>
                            </form>
                            <form method="POST" style="display:inline-block;">
                                <input type="hidden" name="car_id" value="<?php echo $auto['id']; ?>">
                                <button type="submit" name="reject" class="btn btn-danger btn-sm">Afkeuren</button>
                            </form>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        `;
    });

    // Auto Overzicht weergeven
    document.getElementById('overzicht-link').addEventListener('click', function() {
        document.getElementById('main-content').innerHTML = `
            <h2>Auto Overzicht</h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Merk</th>
                        <th>Model</th>
                        <th>Bouwjaar</th>
                        <th>Prijs</th>
                        <th>Afbeelding</th>
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
                            <a href="edit_car.php?id=<?php echo $auto['id']; ?>" class="btn btn-outline-primary btn-sm">Bewerken</a>
                            <a href="delete_car.php?id=<?php echo $auto['id']; ?>" class="btn btn-outline-danger btn-sm" onclick="return confirm('Weet je zeker dat je deze auto wilt verwijderen?');">Verwijderen</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        `;
    });

    // Berichten weergeven
    document.getElementById('berichten-link').addEventListener('click', function() {
        document.getElementById('main-content').innerHTML = `
            <h2>Klanten Berichten</h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Naam</th>
                        <th>Email</th>
                        <th>Bericht</th>
                        <th>Verzonden op</th>
                        <th>Gelezen</th>
                        <th>Acties</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($bericht = mysqli_fetch_assoc($berichten_result)) { ?>
                    <tr>
                        <td><?php echo $bericht['id']; ?></td>
                        <td><?php echo $bericht['naam']; ?></td>
                        <td><?php echo $bericht['email']; ?></td>
                        <td><?php echo $bericht['bericht']; ?></td>
                        <td><?php echo $bericht['datum']; ?></td>
                        <td><?php echo $bericht['gelezen'] == 1 ? 'Ja' : 'Nee'; ?></td>
                        <td>
                            <a href="markeer_gelezen.php?id=<?php echo $bericht['id']; ?>" class="btn btn-outline-primary btn-sm">Markeer als gelezen</a>
                            <a href="delete_bericht.php?id=<?php echo $bericht['id']; ?>" class="btn btn-outline-danger btn-sm" onclick="return confirm('Weet je zeker dat je dit bericht wilt verwijderen?');">Verwijderen</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        `;
    });

    // Formulier voor e-mail sturen weergeven
    document.getElementById('email-link').addEventListener('click', function() {
        document.getElementById('main-content').innerHTML = `
            <h2>Mail Sturen</h2>
            <form method="POST" action="">
                <div class="mb-3">
                    <label for="to" class="form-label">Naar (E-mail)</label>
                    <input type="email" name="to" class="form-control" placeholder="Voer het e-mailadres in" required>
                </div>
                <div class="mb-3">
                    <label for="subject" class="form-label">Onderwerp</label>
                    <input type="text" name="subject" class="form-control" placeholder="Voer het onderwerp in" required>
                </div>
                <div class="mb-3">
                    <label for="message" class="form-label">Bericht</label>
                    <textarea name="message" class="form-control" rows="4" placeholder="Voer het bericht in" required></textarea>
                </div>
                <button type="submit" name="send_email" class="btn btn-primary">Verstuur E-mail</button>
            </form>
        `;
    });

</script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

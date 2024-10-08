<?php
session_start();
include 'config.php'; // Verbind met de database

// Controleer of de gebruiker is ingelogd en een admin is
if (!isset($_SESSION['user']) || $_SESSION['rol'] != 'admin') {
    header('Location: login.php');
    exit();
}

// Haal de auto-informatie op uit de database
if (isset($_GET['id'])) {
    $auto_id = $_GET['id'];
    $auto_query = "SELECT * FROM cars WHERE id = $auto_id";
    $auto_result = mysqli_query($conn, $auto_query);
    $auto = mysqli_fetch_assoc($auto_result);
    $huidige_afbeelding = $auto['afbeelding']; // Bewaar de huidige afbeelding
}

// Update auto-informatie
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $merk = $_POST['merk'];
    $model = $_POST['model'];
    $bouwjaar = $_POST['bouwjaar'];
    $prijs = $_POST['prijs'];
    $beschrijving = $_POST['beschrijving'];

    // Verwerk de afbeelding
    if (!empty($_FILES['afbeelding']['name'])) {
        $afbeelding = $_FILES['afbeelding']['name'];
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["afbeelding"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Controleer of het bestand een echte afbeelding is
        $check = getimagesize($_FILES["afbeelding"]["tmp_name"]);
        if ($check === false) {
            echo "Het bestand is geen afbeelding.<br>";
            exit();
        }

        // Controleer het bestandstype (alleen bepaalde extensies toestaan)
        $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($imageFileType, $allowed_types)) {
            echo "Alleen JPG, JPEG, PNG en GIF bestanden zijn toegestaan.<br>";
            exit();
        }

        // Controleer de bestandsgrootte (max 5MB)
        if ($_FILES["afbeelding"]["size"] > 5000000) {
            echo "Sorry, je bestand is te groot. Maximaal 5MB toegestaan.<br>";
            exit();
        }

        // Verplaats het geüploade bestand naar de uploads-map
        if (move_uploaded_file($_FILES["afbeelding"]["tmp_name"], $target_file)) {
            // Gebruik de nieuwe afbeelding
            $afbeelding = $target_file;
        } else {
            echo "Fout bij het uploaden van de afbeelding.<br>";
            exit();
        }
    } else {
        // Als er geen nieuwe afbeelding is geüpload, gebruik de bestaande afbeelding
        $afbeelding = $huidige_afbeelding;
    }

    // Update de gegevens in de database, inclusief de afbeelding (indien gewijzigd)
    $update_query = "UPDATE cars SET merk='$merk', model='$model', bouwjaar='$bouwjaar', prijs='$prijs', beschrijving='$beschrijving', afbeelding='$afbeelding' WHERE id = $auto_id";

    if (mysqli_query($conn, $update_query)) {
        echo "
        <div class='success-message'>
            <h2>Auto succesvol bijgewerkt!</h2>
            <p>De auto <strong>$merk $model</strong> is succesvol bijgewerkt.</p>
            <a href='admin.php' class='btn-back'>Terug naar het Admin Panel</a>
        </div>
        ";
    } else {
        echo "Er is een fout opgetreden bij het bijwerken van de auto: " . mysqli_error($conn) . "<br>";
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auto Bewerken</title>
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>
    <div class="form-container">
        <h2>Auto Bewerken</h2>
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="merk">Merk</label>
                <input type="text" name="merk" value="<?php echo $auto['merk']; ?>" required class="form-control">
            </div>
            <div class="form-group">
                <label for="model">Model</label>
                <input type="text" name="model" value="<?php echo $auto['model']; ?>" required class="form-control">
            </div>
            <div class="form-group">
                <label for="bouwjaar">Bouwjaar</label>
                <input type="number" name="bouwjaar" value="<?php echo $auto['bouwjaar']; ?>" required class="form-control">
            </div>
            <div class="form-group">
                <label for="prijs">Prijs</label>
                <input type="text" name="prijs" value="<?php echo $auto['prijs']; ?>" required class="form-control">
            </div>
            <div class="form-group">
                <label for="beschrijving">Beschrijving</label>
                <textarea name="beschrijving" class="form-control" required><?php echo $auto['beschrijving']; ?></textarea>
            </div>
            <div class="form-group">
                <label for="afbeelding">Huidige Afbeelding</label>
                <!-- Corrigeer de URL voor het tonen van de afbeelding -->
                <img src="<?php echo $auto['afbeelding']; ?>" alt="Auto Afbeelding" style="width: 200px;">
            </div>
            <div class="form-group">
                <label for="afbeelding">Nieuwe Afbeelding (optioneel)</label>
                <input type="file" name="afbeelding" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Bijwerken</button>
        </form>
    </div>
</body>
</html>

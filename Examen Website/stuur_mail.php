<?php
session_start();
include 'config.php'; // Verbind met de database

// Controleer of de gebruiker is ingelogd en een admin is
if (!isset($_SESSION['user']) || $_SESSION['rol'] != 'admin') {
    header('Location: login.php');
    exit();
}

// Haal klantgegevens op uit de database
$klanten_query = "SELECT email FROM users WHERE rol='klant'";
$klanten_result = mysqli_query($conn, $klanten_query);

// Controleer of het formulier is ingediend
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $onderwerp = $_POST['onderwerp'];
    $bericht = $_POST['bericht'];
    $headers = "From: info@premiumwagens.nl"; // Zorg ervoor dat je het juiste e-mailadres gebruikt

    // Verstuur de e-mail naar alle klanten
    while ($klant = mysqli_fetch_assoc($klanten_result)) {
        $to = $klant['email'];
        mail($to, $onderwerp, $bericht, $headers);
    }

    // Bevestiging dat de e-mails zijn verzonden
    echo "<script>alert('De e-mails zijn succesvol verstuurd naar alle klanten.');</script>";
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-mail naar Klanten - PremiumWagens</title>
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>

    <div class="email-container">
        <h2>Stuur een E-mail naar alle klanten</h2>
        <form method="POST" action="stuur_mail.php">
            <div class="form-group">
                <label for="onderwerp">Onderwerp</label>
                <input type="text" id="onderwerp" name="onderwerp" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="bericht">Bericht</label>
                <textarea id="bericht" name="bericht" class="form-control" rows="10" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Verstuur E-mail</button>
        </form>
    </div>

</body>
</html>

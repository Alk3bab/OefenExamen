<?php
session_start();
include 'config.php'; // Verbind met de database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $naam = $_POST['naam'];
    $email = $_POST['email'];
    $password = md5($_POST['password']); // Wachtwoord versleutelen

    // Controleer of het e-mailadres al bestaat
    $check_query = "SELECT * FROM users WHERE email='$email'";
    $check_result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        $error = "E-mailadres bestaat al. Probeer een ander e-mailadres.";
    } else {
        // Voeg de gebruiker toe aan de database
        $query = "INSERT INTO users (naam, email, wachtwoord, rol) VALUES ('$naam', '$email', '$password', 'klant')";
        if (mysqli_query($conn, $query)) {
            $_SESSION['user'] = $naam;
            $_SESSION['email'] = $email;
            $_SESSION['rol'] = 'klant';
            header('Location: klant.php'); // Stuur de gebruiker naar de klantpagina na registratie
            exit();
        } else {
            $error = "Er is iets misgegaan. Probeer het opnieuw.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Aanmaken - PremiumWagens</title>
    <link rel="stylesheet" href="css/register.css">
</head>
<body>

    <div class="register-container">
        <div class="register-image">
            <div class="image-text">
                <h2>Welkom</h2>
                <p>Maak hier gratis een account aan</p>
            </div>
            <img src="img/login.jpg" alt="Registratie afbeelding">
        </div>
        <div class="register-box">
            <form method="POST" action="register.php">
                <div class="form-group">
                    <label for="naam">Naam</label>
                    <input type="text" name="naam" required class="form-control" placeholder="Voer je naam in">
                </div>
                <div class="form-group">
                    <label for="email">E-mailadres</label>
                    <input type="email" name="email" required class="form-control" placeholder="Voer je e-mailadres in">
                </div>
                <div class="form-group">
                    <label for="password">Wachtwoord</label>
                    <input type="password" name="password" required class="form-control" placeholder="Voer je wachtwoord in">
                </div>
                <button type="submit" class="btn btn-primary">Account Aanmaken</button>
                
                <?php if (isset($error)) { echo "<p class='error'>$error</p>"; } ?>
            </form>
            <p>Heb je al een account? <a href="login.php">Log hier in</a></p>
        </div>
    </div>

</body>
</html>

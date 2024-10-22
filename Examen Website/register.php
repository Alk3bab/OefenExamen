<?php
session_start();
include 'config.php'; // Verbind met de juiste database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $naam = $_POST['naam'];
    $email = $_POST['email'];
    $password = md5($_POST['password']); // Versleutelen van het wachtwoord

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
    <title>Registreren - PremiumWagens</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <!-- Register Container -->
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card shadow-lg p-4" style="max-width: 400px; width: 100%;">
            <div class="card-body">
                <h2 class="text-center mb-4">Account Aanmaken</h2>
                <form method="POST" action="register.php">
                    <div class="mb-3">
                        <label for="naam" class="form-label">Naam</label>
                        <input type="text" name="naam" required class="form-control" placeholder="Voer je naam in">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">E-mailadres</label>
                        <input type="email" name="email" required class="form-control" placeholder="Voer je e-mailadres in">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Wachtwoord</label>
                        <input type="password" name="password" required class="form-control" placeholder="Voer je wachtwoord in">
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Account Aanmaken</button>

                    <div class="text-center mt-3">
                        <p>Heb je al een account? <a href="login.php">Log hier in</a></p>
                        <p><a href="index.php">Terug naar Homepagina</a></p>
                    </div>

                    <?php if (isset($error)) { echo "<p class='text-danger text-center'>$error</p>"; } ?>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

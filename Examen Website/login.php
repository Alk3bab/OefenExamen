<?php
session_start();
include 'config.php'; // Zorg ervoor dat je verbinding maakt met de juiste database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = md5($_POST['password']); // Je kunt dit vervangen door password_hash() voor extra veiligheid

    // Query om de gebruiker op te halen op basis van het ingevoerde e-mailadres en wachtwoord
    $query = "SELECT * FROM users WHERE email='$email' AND wachtwoord='$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);
        $_SESSION['user'] = $user['naam'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['rol'] = $user['rol'];

        // Controleer de rol van de gebruiker
        if ($user['rol'] == 'admin') {
            header('Location: admin.php'); // Admin wordt doorgestuurd naar adminpagina
        } else {
            header('Location: klant.php'); // Klant wordt doorgestuurd naar klantpagina
        }
    } else {
        $error = "Verkeerd e-mailadres of wachtwoord";
    }
    
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - PremiumWagens</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>

    <!-- Login Container -->
    <div class="login-wrapper">
        <div class="login-banner">
            <h1>Welkom</h1>
            <p>Log in om verder te gaan</p>
        </div>
        <div class="login-form-container">
            <h2>Inloggen</h2>
            <form method="POST" action="login.php">
                <div class="form-group">
                    <label for="email">E-mailadres</label>
                    <input type="email" name="email" required class="form-control" placeholder="Voer je e-mailadres in">
                </div>
                <div class="form-group">
                    <label for="password">Wachtwoord</label>
                    <input type="password" name="password" required class="form-control" placeholder="Voer je wachtwoord in">
                </div>

                <button type="submit" class="btn btn-primary">Inloggen</button>
                <p>Nog geen account? <a href="register.php">Maak er een aan</a></p>
                <p>Terug naa<a href="index.php">Homepagina</a></p>



                <?php if (isset($error)) { echo "<p class='error'>$error</p>"; } ?>
            </form>
        </div>
    </div>

</body>
</html>

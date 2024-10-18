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
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <!-- Login Container -->
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card shadow-lg p-4" style="max-width: 400px; width: 100%;">
            <div class="card-body">
                <h2 class="text-center mb-4">Inloggen</h2>
                <form method="POST" action="login.php">
                    <div class="mb-3">
                        <label for="email" class="form-label">E-mailadres</label>
                        <input type="email" name="email" required class="form-control" placeholder="Voer je e-mailadres in">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Wachtwoord</label>
                        <input type="password" name="password" required class="form-control" placeholder="Voer je wachtwoord in">
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Inloggen</button>

                    <div class="text-center mt-3">
                        <p>Nog geen account? <a href="register.php">Maak er een aan</a></p>
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

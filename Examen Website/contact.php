<?php
// Database verbinding
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "premiumwagens_db";

// Maak verbinding met de database
$conn = new mysqli($servername, $username, $password, $dbname);

// Controleer de verbinding
if ($conn->connect_error) {
    die("Verbinding mislukt: " . $conn->connect_error);
}

$berichtVerzonden = false;

// Verwerk het formulier om een bericht op te slaan
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $naam = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $bericht = mysqli_real_escape_string($conn, $_POST['message']);

    // Voeg het bericht toe aan de 'berichten' tabel
    $query = "INSERT INTO berichten (naam, email, bericht) VALUES ('$naam', '$email', '$bericht')";
    
    if (mysqli_query($conn, $query)) {
        $berichtVerzonden = true;
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PremiumWagens - Contact</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
        /* Contactpagina styling */
        .contact-header {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 100px 0;
            position: relative;
            transition: all 0.5s ease-in-out;
        }

        .contact-header h1, .contact-header p {
            transition: all 0.5s ease-in-out;
        }

        .contact-header.flip h1, .contact-header.flip p {
            transform: rotateY(360deg);
        }

        .contact-header h1.success {
            opacity: 1;
            color: green; /* Maak "Bedankt!" groen */
        }

        .contact-header p.success {
            opacity: 1;
            color: white; /* Maak de rest van de tekst wit */
        }

        .contact-form-section {
            padding: 60px 0;
            background-color: #f0f0f0;
        }

        .contact-form {
            background-color: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .contact-form input, .contact-form textarea {
            border-radius: 5px;
            border: 1px solid #ddd;
            padding: 15px;
            width: 100%;
            margin-bottom: 20px;
            box-shadow: none;
            transition: border-color 0.3s ease;
        }

        .contact-form input:focus, .contact-form textarea:focus {
            border-color: #007bff;
        }

        .btn-submit {
            background-color: #007bff;
            color: white;
            font-size: 1.2rem;
            padding: 10px 30px;
            border-radius: 50px;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .btn-submit:hover {
            background-color: #0056b3;
            transform: translateY(-3px);
        }

        /* Witte achtergrond met schaduw voor de contactgegevens sectie */
        .info-box {
            background-color: #fff;
            color: black;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .info-box h5 {
            font-size: 1.8rem;
            font-weight: bold;
        }

        .info-box p {
            font-size: 1.2rem;
            font-weight: 300;
        }

        .info-box p strong {
            font-weight: 600;
        }

        /* Google Maps full width */
        .map-container {
            width: 100%;
            height: 400px;
            position: relative;
        }

        .map-container iframe {
            border: 0;
            width: 100%;
            height: 100%;
        }
    </style>
</head>
<body>

    <!-- Navigatiebalk -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="index.php">PremiumWagens</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Inloggen</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Contactpagina Header -->
    <header class="contact-header" id="header">
        <div class="container">
            <h1 id="contact-title">Contacteer Ons</h1>
            <p id="contact-text">We horen graag van u! Laat ons weten hoe we kunnen helpen.</p>
        </div>
    </header>

    <!-- Contactformulier Sectie -->
    <section class="contact-form-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="info-box">
                        <h5>Onze Gegevens</h5>
                        <p><strong>Adres:</strong> Jan Ligthartstraat 250, 3083 AM Rotterdam</p>
                        <p><strong>Telefoon:</strong> +31 6 12345678</p>
                        <p><strong>Email:</strong> info@premiumwagens.nl</p>
                        <p><strong>Openingstijden:</strong><br>
                        Ma - Vr: 09:00 - 18:00<br>
                        Za: 10:00 - 16:00<br>
                        Zo: Gesloten</p>
                    </div>
                </div>
                <div class="col-lg-6 mb-4" data-aos="fade-up">
                    <form class="contact-form" method="POST" action="">
                        <div class="mb-3">
                            <input type="text" name="name" placeholder="Uw Naam" required>
                        </div>
                        <div class="mb-3">
                            <input type="email" name="email" placeholder="Uw Email" required>
                        </div>
                        <div class="mb-3">
                            <textarea name="message" placeholder="Uw Bericht" rows="5" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-submit" id="submit-btn">Verstuur Bericht</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Map -->
    <div class="map-container">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2462.110518113442!2d4.4574595!3d51.9026045!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c5ce23edc83b0d%3A0x35ad0f21a4c882a9!2sJan%20Ligthartstraat%20250%2C%203083%20AM%20Rotterdam!5e0!3m2!1snl!2snl!4v1697465919671!5m2!1snl!2snl" allowfullscreen="" loading="lazy"></iframe>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script>
        AOS.init();

        // Check if the message was sent successfully
        <?php if ($berichtVerzonden) { ?>
        document.addEventListener('DOMContentLoaded', function() {
            const title = document.getElementById('contact-title');
            const text = document.getElementById('contact-text');
            const header = document.getElementById('header');

            // Eerst verander de tekst naar bedankt en draai het
            header.classList.add('flip');
            title.textContent = "Bedankt!";
            text.textContent = "We nemen zo snel mogelijk contact met je op.";
            title.style.color = "green"; // Groene tekst voor "Bedankt!"
            text.style.color = "white"; // Witte tekst voor de rest

            // Na 2 seconden, verander het terug naar 'Contacteer Ons' en draai terug
            setTimeout(function() {
                header.classList.remove('flip');
                title.textContent = "Contacteer Ons";
                text.textContent = "We horen graag van u! Laat ons weten hoe we kunnen helpen.";
                title.style.color = "white"; // Herstel naar wit
                text.style.color = "white"; // Herstel naar wit
            }, 2000);
        });
        <?php } ?>
    </script>
</body>
</html>

<?php
// Sluit de databaseverbinding
$conn->close();
?>

<?php
// Database verbinding
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "premiumwagens_db"; // Database naam

// Maak verbinding met de database
$conn = new mysqli($servername, $username, $password, $dbname);

// Controleer de verbinding
if ($conn->connect_error) {
    die("Verbinding mislukt: " . $conn->connect_error);
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PremiumWagens - Verkoop Uw Auto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <style>
        /* Eerste sectie zoals de tweede foto */
        .hero-section {
            background-color: #343a40; /* Donkergrijze achtergrond */
            color: white;
            height: 50vh;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .hero-section h1 {
            font-size: 3rem;
        }

        .sell-car-section {
            background-color: #f7f7f7;
            padding: 60px 0;
        }

        .sell-car-section h2 {
            margin-bottom: 20px;
            font-weight: bold;
        }

        .sell-car-section p {
            font-size: 1.1rem;
            margin-bottom: 30px;
        }

        .info-box {
            background-color: #ffffff;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        .btn-custom {
            padding: 12px 20px;
            font-size: 1.2rem;
            border-radius: 50px;
            background-color: #ffc107; /* Gele knop */
            color: white;
            border: none;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .btn-custom:hover {
            background-color: #e0a800;
            transform: translateY(-5px);
        }

        /* Verkoop Voordelen sectie */
        .benefits-section {
            background-color: #343a40;
            color: white;
            padding: 60px 0;
        }

        .benefits-section h4 {
            font-weight: bold;
        }

        /* Laatste sectie met invulvelden */
        .input-section {
            background-color: #f7f7f7;
            padding: 60px 0;
            text-align: center;
        }

        .input-section .form-group {
            margin-bottom: 20px;
        }

        .input-section .btn-custom {
            background-color: #ffc107;
            color: white;
            border: none;
            padding: 12px 20px;
            font-size: 1.2rem;
            border-radius: 50px;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .input-section .btn-custom:hover {
            background-color: #e0a800;
            transform: translateY(-5px);
        }
        
        .footer a {
            color: #f8c146;
            transition: color 0.3s ease;
        }

        .footer a:hover {
            color: #ffdd57;
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

    <!-- Eerste sectie -->
    <section class="hero-section">
        <h1>Verkoop Uw Auto bij PremiumWagens</h1>
    </section>

    <!-- Verkoop Uw Auto Sectie -->
    <section class="sell-car-section">
        <div class="container">
            <h2 class="text-center">Hoe werkt het?</h2>
            <p class="text-center">Wilt u uw auto snel en gemakkelijk verkopen? Bij PremiumWagens helpen we u om uw auto online te adverteren en in contact te komen met potentiële kopers. Volg deze eenvoudige stappen:</p>
            
            <!-- Stappenplan -->
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="info-box" data-aos="fade-up" data-aos-delay="100">
                        <h4>1. Maak een account aan</h4>
                        <p>Het aanmaken van een account is gratis en eenvoudig. Zodra u een account heeft, krijgt u toegang tot ons gebruiksvriendelijke platform om uw auto's te beheren.</p>
                    </div>
                    <div class="info-box" data-aos="fade-up" data-aos-delay="200">
                        <h4>2. Voeg uw auto toe</h4>
                        <p>Vul de details van uw auto in, zoals merk, model, bouwjaar, kilometerstand en prijs. Upload duidelijke en aantrekkelijke foto's van uw auto om de kans op verkoop te vergroten.</p>
                    </div>
                    <div class="info-box" data-aos="fade-up" data-aos-delay="300">
                        <h4>3. Optimaliseer uw advertentie</h4>
                        <p>Schrijf een gedetailleerde beschrijving van uw auto en geef aan waarom deze het waard is om te kopen. U kunt uw advertentie op elk moment bijwerken of aanpassen via uw account.</p>
                    </div>
                    <div class="info-box" data-aos="fade-up" data-aos-delay="400">
                        <h4>4. Reageer op geïnteresseerde kopers</h4>
                        <p>Potentiële kopers kunnen contact met u opnemen via ons platform. U kunt eenvoudig reageren op vragen of een afspraak maken voor een bezichtiging of proefrit.</p>
                    </div>
                    <div class="info-box" data-aos="fade-up" data-aos-delay="500">
                        <h4>5. Verkoop uw auto</h4>
                        <p>Wanneer u een koper heeft gevonden, regelt u de verkoop eenvoudig via ons platform. Wij helpen u met tips en informatie om de verkoop soepel te laten verlopen.</p>
                    </div>
                    <a href="register.php" class="btn btn-custom mt-4">Maak een account aan</a>
                </div>
            </div>
        </div>
    </section>

    

    <!-- Footer -->
    <footer class="footer py-4 bg-dark text-white">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5>Contact</h5>
                    <p>PremiumWagens<br>
                       Adres: Hoofdstraat 123, 1234 AB, Nederland<br>
                       Telefoon: +31 6 12345678<br>
                       Email: info@premiumwagens.nl</p>
                </div>
                <div class="col-md-4">
                    <h5>Navigatie</h5>
                    <ul class="list-unstyled">
                        <li><a href="index.php" class="text-white">Home</a></li>
                        <li><a href="occasions.php" class="text-white">Occasions</a></li>
                        <li><a href="verkopen.php" class="text-white">Auto Verkopen</a></li>
                        <li><a href="login.php" class="text-white">Inloggen</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>Volg Ons</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white">Facebook</a></li>
                        <li><a href="#" class="text-white">Instagram</a></li>
                        <li><a href="#" class="text-white">Twitter</a></li>
                    </ul>
                </div>
            </div>
            <div class="text-center mt-3">
                <p>&copy; 2024 PremiumWagens. Alle rechten voorbehouden.</p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>
</html>

<?php
// Sluit de databaseverbinding
$conn->close();
?>

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
    <title>PremiumWagens - Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
        /* Geanimeerde navigatiebalk */
        .navbar {
            transition: all 0.5s ease;
        }

        .navbar.scrolled {
            background-color: rgba(0, 0, 0, 0.9) !important;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
        }

        .navbar-nav .nav-link {
            font-size: 1.1rem;
            transition: color 0.3s ease;
        }

        .navbar-nav .nav-link:hover {
            color: #f8c146 !important;
        }

        /* "Zoek naar jouw auto" sectie styling */
        .search-filters-section {
            background-image: linear-gradient(to bottom right, #007bff, #6610f2);
            padding: 60px 0;
            border-radius: 10px;
        }

        .search-filters-section h2 {
            color: white;
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 30px;
            animation: fadeInDown 1s ease;
        }

        .form-select {
            background-color: white;
            border: none;
            padding: 15px;
            border-radius: 5px;
            transition: box-shadow 0.3s ease;
        }

        .form-select:focus {
            box-shadow: 0 0 10px rgba(0, 123, 255, 0.6);
        }

        .btn-primary {
            padding: 12px 20px;
            font-size: 1.2rem;
            border-radius: 50px;
            background-color: #f8c146;
            border: none;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #ffdd57;
            transform: translateY(-5px);
        }

        /* Animaties */
        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>

    <!-- Navigatiebalk -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">PremiumWagens</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Zoeken</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="verkopen.php">Verkopen</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="auto-info.php">Auto informatie</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Inloggen</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Sectie met Video en Dynamische Tekst -->
    <div class="hero" style="margin-top: 80px;">
        <video autoplay muted loop class="w-100" style="object-fit: cover; height: 70vh;">
            <source src="video/hero-video.mp4" type="video/mp4">
            <!-- Fallback afbeelding -->
        </video>
        <div class="hero-text text-center text-white" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 2;">
            <h1>Welkom bij PremiumWagens</h1>
            <p><span id="usp-text">Betrouwbare auto's</span></p>
            <a href="occasions.php" class="btn btn-primary btn-lg">Bekijk Onze Occasions</a>
        </div>
    </div>

    <!-- Waarom Kiezen Voor Ons Sectie -->
    <section class="why-choose-us-section bg-light py-5">
        <div class="container text-center">
            <h2 data-aos="fade-up">Waarom Kiezen Voor PremiumWagens?</h2>
            <p data-aos="fade-up" data-aos-delay="100">Wij bieden u de beste tweedehands auto-ervaring met betrouwbare service en gegarandeerde kwaliteit.</p>
            <div class="row mt-4">
                <div class="col-md-4" data-aos="zoom-in" data-aos-delay="200">
                    <div class="why-choose-box">
                        <i class="fas fa-car fa-3x mb-3"></i>
                        <h4>Ruime Selectie</h4>
                        <p>Wij hebben een breed aanbod van zorgvuldig geselecteerde tweedehands auto's.</p>
                    </div>
                </div>
                <div class="col-md-4" data-aos="zoom-in" data-aos-delay="300">
                    <div class="why-choose-box">
                        <i class="fas fa-shield-alt fa-3x mb-3"></i>
                        <h4>Gegarandeerde Kwaliteit</h4>
                        <p>Elke auto wordt grondig geïnspecteerd om aan onze kwaliteitsnormen te voldoen.</p>
                    </div>
                </div>
                <div class="col-md-4" data-aos="zoom-in" data-aos-delay="400">
                    <div class="why-choose-box">
                        <i class="fas fa-tools fa-3x mb-3"></i>
                        <h4>Uitstekende Ondersteuning</h4>
                        <p>Onze deskundige medewerkers staan altijd voor u klaar, van aankoop tot onderhoud.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Uitgebreide Filter voor Occasions -->
    <section class="search-filters-section py-5">
        <div class="container">
            <h2 class="text-center" data-aos="fade-up">Zoek naar jouw ideale auto</h2>
            <form action="occasions.php" method="get" class="row mt-4 justify-content-center" data-aos="fade-up" data-aos-delay="100">
                <div class="col-md-3 mb-3">
                    <select name="merk" class="form-select">
                        <option value="">Merk</option>
                        <option value="audi">Audi</option>
                        <option value="bmw">BMW</option>
                        <option value="mercedes">Mercedes</option>
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <select name="prijs" class="form-select">
                        <option value="">Prijs</option>
                        <option value="10000">Tot €10.000</option>
                        <option value="20000">Tot €20.000</option>
                        <option value="30000">Tot €30.000</option>
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <select name="jaar" class="form-select">
                        <option value="">Bouwjaar</option>
                        <option value="2015">Vanaf 2015</option>
                        <option value="2018">Vanaf 2018</option>
                        <option value="2020">Vanaf 2020</option>
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <select name="kilometerstand" class="form-select">
                        <option value="">Kilometerstand</option>
                        <option value="50000">Tot 50.000 km</option>
                        <option value="100000">Tot 100.000 km</option>
                        <option value="150000">Tot 150.000 km</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary w-100">Zoek Auto's</button>
                </div>
            </form>
        </div>
    </section>

    <!-- Top Occasions Sectie met dynamische auto's uit database -->
    <section class="top-occasions py-5">
        <div class="container text-center">
            <h2 class="mb-4" data-aos="fade-down">Top Occasions</h2>
            <div class="row">
                <?php
                // Query om auto's uit de database op te halen
                $sql = "SELECT id, model, prijs, afbeelding_url FROM cars LIMIT 3"; // Limiteer tot 3 auto's
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // Output van elke rij
                    while($row = $result->fetch_assoc()) {
                        echo '<div class="col-md-4" data-aos="flip-left" data-aos-delay="200">';
                        echo '<div class="occasion-card">';
                        echo '<img src="' . $row["afbeelding_url"] . '" alt="' . $row["model"] . '" class="img-fluid mb-3">';
                        echo '<h3>' . $row["model"] . '</h3>';
                        echo '<p class="price">€ ' . number_format($row["prijs"], 0, ',', '.') . ',-</p>';
                        echo '<a href="occasions.php?id=' . $row["id"] . '" class="btn btn-outline-primary">Bekijk Meer</a>';
                        echo '</div>';
                        echo '</div>';
                    }
                } else {
                    echo "<p>Geen auto's beschikbaar</p>";
                }
                ?>
            </div>
        </div>
    </section>

    <!-- Uitgebreide Footer -->
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
        
        // Dynamische USP tekst in de hero-sectie
        let usps = ['Betrouwbare auto\'s', 'Uitstekende service', 'Scherpe prijzen', 'Uitgebreid assortiment'];
        let uspIndex = 0;

        function changeUSP() {
            let uspText = document.getElementById('usp-text');
            uspText.innerHTML = usps[uspIndex];
            uspIndex = (uspIndex + 1) % usps.length;
        }

        setInterval(changeUSP, 3000); // Wissel elke 3 seconden

        // Navbar scroll animatie
        window.onscroll = function () {
            var navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        };
    </script>
</body>
</html>

<?php
// Sluit de databaseverbinding
$conn->close();
?>


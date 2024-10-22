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
        /* Hero Sectie Stijlen */
        .hero {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            margin-top: 0;
            padding: 0;
            overflow: hidden;
        }

        .hero video {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -1;
        }

        .hero-text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            text-align: center;
            z-index: 1;
        }

        .btn-custom {
            padding: 12px 20px;
            font-size: 1.2rem;
            border-radius: 50px;
            background-color: #ffc107;
            border: none;
            transition: background-color 0.3s ease, transform 0.3s ease;
            margin: 0 10px;
        }

        .btn-custom:hover {
            background-color: #e0a800;
            transform: translateY(-5px);
        }

        /* Flexbox voor knoppen */
        .btn-container {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        /* Statistieken sectie */
        .stats-section {
            background-color: #343a40;
            padding: 60px 0;
            color: white;
        }

        .stats-section .counter {
            font-size: 3rem;
            font-weight: bold;
        }

        /* Zoeken naar jouw perfecte auto sectie */
        .search-section {
            background-color: #f8f9fa;
            padding: 60px 0;
            text-align: center;
        }

        .search-section h2 {
            margin-bottom: 30px;
        }

        .form-select, .form-control {
            margin-bottom: 20px;
        }

        /* Top Occasions sectie */
        .top-occasions {
            background-color: #f8f9fa;
        }
        .occasion-card {
            transition: transform 0.5s ease;
        }
        .occasion-card:hover {
            transform: scale(1.05);
        }

        /* Klantbeoordelingen sectie */
        .reviews-section {
            background-color: #e9ecef;
            padding: 60px 0;
            text-align: center;
        }

        .review-box {
            background-color: white;
            padding: 20px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            margin-bottom: 20px;
            animation: fadeInUp 1s ease;
        }

        .review-text {
            font-style: italic;
        }

        /* Footer */
        .footer {
            background-color: #343a40;
            color: white;
            padding: 40px 0;
        }

        .footer a {
            color: #f8c146;
            transition: color 0.3s ease;
        }

        .footer a:hover {
            color: #ffdd57;
        }

        /* Animaties */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
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
                        <a class="nav-link" href="contact.php">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Inloggen</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Sectie -->
    <div class="hero">
        <video autoplay muted loop>
            <source src="video/hero-video.mp4" type="video/mp4">
            <!-- Fallback afbeelding -->
        </video>
        <div class="hero-text">
            <h1>Welkom bij PremiumWagens</h1>
            <p>Uitgebreid assortiment</p>
            <div class="btn-container">
                <a href="occasions.php" class="btn btn-custom">Bekijk Onze Occasions</a>
                <a href="verkoop.php" class="btn btn-custom">Verkoop Uw Auto</a>
            </div>
        </div>
    </div>

    <!-- Prestaties sectie -->
    <section class="stats-section">
        <div class="container text-center">
            <h2 data-aos="fade-up">Onze Prestaties</h2>
            <div class="row mt-4">
                <div class="col-md-3" data-aos="fade-up" data-aos-delay="100">
                    <h3><span class="counter" data-target="444">0</span>+</h3>
                    <p>Auto's verkocht</p>
                </div>
                <div class="col-md-3" data-aos="fade-up" data-aos-delay="200">
                    <h3><span class="counter" data-target="120">0</span>+</h3>
                    <p>Tevreden klanten</p>
                </div>
                <div class="col-md-3" data-aos="fade-up" data-aos-delay="300">
                    <h3><span class="counter" data-target="30">0</span>+</h3>
                    <p>Jaar ervaring</p>
                </div>
                <div class="col-md-3" data-aos="fade-up" data-aos-delay="400">
                    <h3><span class="counter" data-target="148">0</span>+</h3>
                    <p>Occasions beschikbaar</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Zoeken naar jouw perfecte auto sectie -->
    <section class="search-section">
        <div class="container">
            <h2>Vind jouw perfecte auto</h2>
            <form action="occasions.php" method="get" class="row justify-content-center">
                <div class="col-md-4">
                    <select class="form-select" name="merk">
                        <option value="">Merk</option>
                        <option value="audi">Audi</option>
                        <option value="bmw">BMW</option>
                        <option value="mercedes">Mercedes</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <input type="number" class="form-control" name="bouwjaar" placeholder="Bouwjaar" min="1980">
                </div>
                <div class="col-md-4">
                    <input type="number" class="form-control" name="kilometerstand" placeholder="Max kilometerstand" min="0">
                </div>
                <div class="col-md-12 mt-3">
                    <button type="submit" class="btn btn-primary w-100">Zoek Auto's</button>
                </div>
            </form>
        </div>
    </section>

    <!-- Top Occasions -->
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

    <!-- Klantbeoordelingen sectie -->
    <section class="reviews-section">
        <div class="container">
            <h2>Wat onze klanten zeggen</h2>
            <div class="row">
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="review-box">
                        <p class="review-text">"Geweldige ervaring! De service was uitstekend en ik ben zeer tevreden met mijn nieuwe auto."</p>
                        <p><strong>- John Doe</strong></p>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="review-box">
                        <p class="review-text">"PremiumWagens biedt de beste kwaliteit en een eerlijke prijs. Absoluut een aanrader!"</p>
                        <p><strong>- Jane Smith</strong></p>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="review-box">
                        <p class="review-text">"Fantastische service van begin tot eind. Ik kom hier zeker weer voor mijn volgende auto."</p>
                        <p><strong>- Max Verstappen</strong></p>
                    </div>
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

        // Counter animatie voor de stats sectie
        document.querySelectorAll('.counter').forEach(counter => {
            const updateCount = () => {
                const target = +counter.getAttribute('data-target');
                const count = +counter.innerText;
                const increment = target / 200;

                if (count < target) {
                    counter.innerText = Math.ceil(count + increment);
                    setTimeout(updateCount, 30);
                } else {
                    counter.innerText = target;
                }
            };
            updateCount();
        });
    </script>
</body>
</html>

<?php
// Sluit de databaseverbinding
$conn->close();
?>

<?php
session_start();
include 'config.php'; // Zorg voor een correcte databaseverbinding

// Haal alle merken uit de database
$merkenQuery = "SELECT DISTINCT merk FROM cars";
$merkenResult = mysqli_query($conn, $merkenQuery);

// Definieer de basis SQL-query voor het filteren van auto's
$query = "SELECT * FROM cars WHERE 1";
$conditions = [];

// Controleer of er filterwaarden zijn opgegeven en voeg ze toe aan de SQL-query
if (!empty($_GET['merk'])) {
    $merk = mysqli_real_escape_string($conn, $_GET['merk']);
    $conditions[] = "merk = '$merk'";
}

if (!empty($_GET['model'])) {
    $model = mysqli_real_escape_string($conn, $_GET['model']);
    $conditions[] = "model LIKE '%$model%'";
}

if (!empty($_GET['bouwjaar'])) {
    $bouwjaar = (int) $_GET['bouwjaar'];
    $conditions[] = "bouwjaar = $bouwjaar";
}

if (!empty($_GET['carrosserietype'])) {
    $carrosserietype = mysqli_real_escape_string($conn, $_GET['carrosserietype']);
    $conditions[] = "carrosserietype LIKE '%$carrosserietype%'";
}

if (!empty($_GET['categorie'])) {
    $categorie = mysqli_real_escape_string($conn, $_GET['categorie']);
    $conditions[] = "categorie LIKE '%$categorie%'";
}

if (!empty($_GET['aandrijving'])) {
    $aandrijving = mysqli_real_escape_string($conn, $_GET['aandrijving']);
    $conditions[] = "aandrijving = '$aandrijving'";
}

if (!empty($_GET['stoelen'])) {
    $stoelen = (int) $_GET['stoelen'];
    $conditions[] = "stoelen = $stoelen";
}

if (!empty($_GET['deuren'])) {
    $deuren = (int) $_GET['deuren'];
    $conditions[] = "deuren = $deuren";
}

if (!empty($_GET['kilometerstand'])) {
    $kilometerstand = (int) $_GET['kilometerstand'];
    $conditions[] = "kilometerstand <= $kilometerstand";
}

if (!empty($_GET['vermogen_kw'])) {
    $vermogen_kw = (int) $_GET['vermogen_kw'];
    $conditions[] = "vermogen_kw = $vermogen_kw";
}

if (!empty($_GET['transmissie'])) {
    $transmissie = mysqli_real_escape_string($conn, $_GET['transmissie']);
    $conditions[] = "transmissie = '$transmissie'";
}

if (!empty($_GET['cilinderinhoud'])) {
    $cilinderinhoud = (int) $_GET['cilinderinhoud'];
    $conditions[] = "cilinderinhoud = $cilinderinhoud";
}

if (!empty($_GET['versnellingen'])) {
    $versnellingen = (int) $_GET['versnellingen'];
    $conditions[] = "versnellingen = $versnellingen";
}

if (!empty($_GET['cilinders'])) {
    $cilinders = (int) $_GET['cilinders'];
    $conditions[] = "cilinders = $cilinders";
}

if (!empty($_GET['leeggewicht'])) {
    $leeggewicht = (int) $_GET['leeggewicht'];
    $conditions[] = "leeggewicht = $leeggewicht";
}

// Voeg alle condities toe aan de query
if (count($conditions) > 0) {
    $query .= " AND " . implode(" AND ", $conditions);
}

// Voer de query uit
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Occasions - PremiumWagens</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        .navbar {
            background-color: #212529;
            padding: 15px 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar .logo a {
            font-size: 24px;
            font-weight: bold;
            color: white;
            text-decoration: none;
        }

        .navbar .nav-links {
            list-style: none;
            display: flex;
            gap: 30px;
        }

        .navbar .nav-links a {
            color: white;
            text-decoration: none;
            font-weight: normal;
        }

        .navbar .nav-links a:hover {
            color: #f39c12;
        }

        .occasion-card {
            background-color: white;
            border-radius: 10px;
            padding: 15px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        .occasion-card img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
        }

        .reserved-label {
            position: absolute;
            top: 10px;
            left: 10px;
            background-color: rgba(255, 0, 0, 0.8);
            color: white;
            padding: 5px 10px;
            font-size: 14px;
            font-weight: bold;
            border-radius: 5px;
        }

        .occasion-info h3 {
            font-size: 20px;
            font-weight: bold;
            margin-top: 10px;
        }

        .occasion-info p {
            font-size: 16px;
            margin: 5px 0;
        }

        .occasion-buttons {
            display: flex;
            gap: 10px;
        }

        .btn-primary {
            background-color: #3498db;
            border-color: #3498db;
        }

        .btn-primary:hover {
            background-color: #2980b9;
        }

        .btn-warning {
            background-color: #f1c40f;
            border-color: #f1c40f;
        }

        .btn-warning:hover {
            background-color: #f39c12;
        }

        .filter {
            background-color: #f8f9fa;
            color: black;
            padding: 20px;
            width: 250px;
            box-sizing: border-box;
            border-radius: 10px;
            border: 1px solid #ddd;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .filter form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .filter label {
            font-weight: bold;
            color: #333;
        }

        .filter input, .filter select {
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            width: 100%;
        }

        .filter button {
            background-color: #3498db;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .filter button:hover {
            background-color: #2980b9;
        }

        .main-content {
            display: flex;
            gap: 20px;
            margin-top: 20px;
        }

        .occasions-grid {
            display: flex;
            flex-direction: column;
            gap: 20px;
            padding: 20px;
            flex: 1;
        }
    </style>
</head>
<body>

<!-- Navigatiebalk -->
<nav class="navbar">
    <div class="container">
        <div class="logo">
            <a href="index.php">PremiumWagens</a>
        </div>
        <ul class="nav-links">
            <li><a href="contact.php">Contact</a></li>
            <li><a href="login.php">Inloggen</a></li>
        </ul>
    </div>
</nav>

<!-- Layout met filter aan de linkerkant en occasions rechts -->
<div class="main-content container">
    <!-- Filter balk -->
    <div class="filter">
        <form action="occasions.php" method="GET">
            <div>
                <label for="merk">Merk:</label>
                <select name="merk" id="merk">
                    <option value="">Alle Merken</option>
                    <?php while ($row = mysqli_fetch_assoc($merkenResult)) : ?>
                        <option value="<?php echo htmlspecialchars($row['merk']); ?>"><?php echo htmlspecialchars($row['merk']); ?></option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div>
                <label for="model">Model:</label>
                <input type="text" name="model" id="model" placeholder="Model">
            </div>

            <div>
                <label for="bouwjaar">Bouwjaar:</label>
                <input type="number" name="bouwjaar" id="bouwjaar" placeholder="Bouwjaar">
            </div>

            <div>
                <label for="carrosserietype">Carrosserietype:</label>
                <input type="text" name="carrosserietype" id="carrosserietype" placeholder="Carrosserietype">
            </div>

            <div>
                <label for="categorie">Categorie:</label>
                <input type="text" name="categorie" id="categorie" placeholder="Categorie">
            </div>

            <div>
                <label for="aandrijving">Aandrijving:</label>
                <input type="text" name="aandrijving" id="aandrijving" placeholder="Aandrijving">
            </div>

            <div>
                <label for="stoelen">Stoelen:</label>
                <input type="number" name="stoelen" id="stoelen" placeholder="Aantal stoelen">
            </div>

            <div>
                <label for="deuren">Deuren:</label>
                <input type="number" name="deuren" id="deuren" placeholder="Aantal deuren">
            </div>

            <div>
                <label for="kilometerstand">Kilometerstand:</label>
                <input type="number" name="kilometerstand" id="kilometerstand" placeholder="Kilometerstand">
            </div>

            <div>
                <label for="vermogen_kw">Vermogen kW (PK):</label>
                <input type="number" name="vermogen_kw" id="vermogen_kw" placeholder="Vermogen kW (PK)">
            </div>

            <div>
                <label for="transmissie">Transmissie:</label>
                <input type="text" name="transmissie" id="transmissie" placeholder="Transmissie">
            </div>

            <div>
                <label for="cilinderinhoud">Cilinderinhoud:</label>
                <input type="number" name="cilinderinhoud" id="cilinderinhoud" placeholder="Cilinderinhoud">
            </div>

            <div>
                <label for="versnellingen">Versnellingen:</label>
                <input type="number" name="versnellingen" id="versnellingen" placeholder="Aantal versnellingen">
            </div>

            <div>
                <label for="cilinders">Cilinders:</label>
                <input type="number" name="cilinders" id="cilinders" placeholder="Aantal cilinders">
            </div>

            <div>
                <label for="leeggewicht">Leeggewicht:</label>
                <input type="number" name="leeggewicht" id="leeggewicht" placeholder="Leeggewicht">
            </div>

            <button type="submit">Filteren</button>
        </form>
    </div>

    <!-- Grid met occasions -->
    <section class="occasions-grid">
        <?php while ($occasion = mysqli_fetch_assoc($result)) : ?>
            <?php
            // Controleer of de auto is gereserveerd
            $auto_id = $occasion['id'];
            $reserveringQuery = "SELECT * FROM reserveringen WHERE auto_id = $auto_id";
            $reserveringResult = mysqli_query($conn, $reserveringQuery);
            $is_reserved = mysqli_num_rows($reserveringResult) > 0;
            ?>
            
            <div class="occasion-card">
                <div class="row">
                    <div class="col-md-4">
                        <!-- Auto afbeelding -->
                        <img src="<?php echo htmlspecialchars($occasion['afbeelding_url']); ?>" alt="Afbeelding van <?php echo htmlspecialchars($occasion['merk']); ?>" style="width:100%;">
                        
                        <!-- Gereserveerd label -->
                        <?php if ($is_reserved): ?>
                            <div class="reserved-label">Gereserveerd</div>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-8">
                        <!-- Auto informatie -->
                        <h3><?php echo htmlspecialchars($occasion['merk']) . " " . htmlspecialchars($occasion['model']); ?></h3>
                        <p>Prijs: €<?php echo number_format($occasion['prijs'], 2, ',', '.'); ?></p>
                        <p>Specificaties: <?php echo htmlspecialchars($occasion['specificaties']); ?></p>
                        
                        <div class="occasion-buttons">
                            <!-- Meer informatie knop -->
                            <a href="auto_detail.php?id=<?php echo htmlspecialchars($occasion['id']); ?>" class="btn btn-primary">Meer Informatie</a>
                            
                            <!-- Reserveren knop, alleen zichtbaar als de auto niet is gereserveerd -->
                            <?php if (!$is_reserved): ?>
                                <a href="reserveren.php?id=<?php echo htmlspecialchars($occasion['id']); ?>" class="btn btn-warning">Reserveren</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </section>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

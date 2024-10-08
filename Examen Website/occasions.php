<?php
session_start();
include 'config.php'; // Zorg ervoor dat je een correcte databaseverbinding hebt

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

if (!empty($_GET['min_prijs'])) {
    $min_prijs = (float) $_GET['min_prijs'];
    $conditions[] = "prijs >= $min_prijs";
}

if (!empty($_GET['max_prijs'])) {
    $max_prijs = (float) $_GET['max_prijs'];
    $conditions[] = "prijs <= $max_prijs";
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
    <link rel="stylesheet" href="css/verkoop.css"> <!-- Verwijs naar je CSS-bestand -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<!-- Navbar boven de banner -->
<nav class="navbar">
    <div class="container">
        <div class="logo">
            <a href="index.php">PremiumWagens</a>
        </div>
        <ul class="nav-links">
            <li><a href="index.php">Home</a></li>
            <li><a href="occasions.php">Occasions</a></li>
            <li><a href="login.php">Login</a></li>
        </ul>
    </div>
</nav>

<!-- Banner van de indexpagina -->
<div class="banner">
    <h1>Welkom bij PremiumWagens</h1>
    <p>Bekijk onze prachtige occasions!</p>
</div>

<!-- Layout met filter aan de linkerkant en occasions rechts -->
<div class="main-content">
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
                <label for="min_prijs">Min. Prijs:</label>
                <input type="number" name="min_prijs" id="min_prijs" placeholder="Minimale Prijs">
            </div>

            <div>
                <label for="max_prijs">Max. Prijs:</label>
                <input type="number" name="max_prijs" id="max_prijs" placeholder="Maximale Prijs">
            </div>

            <button type="submit">Filteren</button>
        </form>
    </div>

    <!-- Grid met occasions -->
    <section class="occasions-grid">
        <?php while ($occasion = mysqli_fetch_assoc($result)) : ?>
        <div class="occasion-card">
            <!-- Debugging: toon de URL van de afbeelding -->
            <p>Afbeelding URL: <?php echo htmlspecialchars($occasion['afbeelding_url']); ?></p>
            
            <!-- Controleer of de URL niet leeg is en geef de afbeelding weer -->
            <img src="<?php echo htmlspecialchars($occasion['afbeelding_url']); ?>" alt="Afbeelding van <?php echo htmlspecialchars($occasion['merk']); ?>" style="width:100%;">
            <div class="occasion-info">
                <h3><?php echo htmlspecialchars($occasion['merk']) . " " . htmlspecialchars($occasion['model']); ?></h3>
                <p>Bouwjaar: <?php echo htmlspecialchars($occasion['bouwjaar']); ?></p>
                <p>Prijs: €<?php echo number_format($occasion['prijs'], 2, ',', '.'); ?></p>
                <!-- Link naar de auto-detailpagina -->
                <a href="auto_detail.php?id=<?php echo htmlspecialchars($occasion['id']); ?>">Meer Informatie</a>
            </div>
        </div>
        <?php endwhile; ?>
    </section>
</div>

</body>
</html>

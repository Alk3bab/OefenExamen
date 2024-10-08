<?php
session_start();
include 'config.php'; // Verbind met de database

// Controleer of de gebruiker is ingelogd en een admin is
if (!isset($_SESSION['user']) || $_SESSION['rol'] != 'admin') {
    header('Location: login.php');
    exit();
}

// Haal klantgegevens en auto's op uit de database
$klanten_query = "SELECT * FROM users WHERE rol='klant'";
$klanten_result = mysqli_query($conn, $klanten_query);

$autos_query = "SELECT * FROM cars ORDER BY created_at DESC";
$autos_result = mysqli_query($conn, $autos_query);
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - PremiumWagens</title>
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>

    <div class="admin-container">
        <!-- Zijbalk met menu -->
        <nav class="sidebar">
            <h2>Admin Dashboard</h2>
            <ul>
                <li><a href="#" id="klanten-link">Klantgegevens</a></li>
                <li><a href="#" id="autos-link">Auto's Toevoegen</a></li>
                <li><a href="#" id="overzicht-link">Auto Overzicht</a></li>
            </ul>
            <div class="sidebar-footer">
                <a href="login.php" class="btn-back">Terug</a>
            </div>
        </nav>

        <!-- Hoofdinhoud -->
        <div class="main-content" id="main-content">
            <h2>Welkom, Admin!</h2>
            <p>Kies een optie uit het menu om te beginnen.</p>
        </div>
    </div>

    <script>
        // Klantgegevens weergeven
        document.getElementById('klanten-link').addEventListener('click', function() {
            document.getElementById('main-content').innerHTML = `
                <h2>Klantgegevens</h2>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Naam</th>
                            <th>Email</th>
                            <th>Aangemaakt op</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($klant = mysqli_fetch_assoc($klanten_result)) { ?>
                        <tr>
                            <td><?php echo $klant['id']; ?></td>
                            <td><?php echo $klant['naam']; ?></td>
                            <td><?php echo $klant['email']; ?></td>
                            <td><?php echo $klant['created_at']; ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            `;
        });

        // Auto's toevoegen weergeven
        document.getElementById('autos-link').addEventListener('click', function() {
            document.getElementById('main-content').innerHTML = `
                <h2>Auto Toevoegen</h2>
                <form method="POST" action="add_car.php">
                    <div class="form-group">
                        <label for="merk">Merk</label>
                        <input type="text" name="merk" required class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="model">Model</label>
                        <input type="text" name="model" required class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="bouwjaar">Bouwjaar</label>
                        <input type="number" name="bouwjaar" required class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="prijs">Prijs</label>
                        <input type="text" name="prijs" required class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="beschrijving">Beschrijving</label>
                        <textarea name="beschrijving" class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="afbeelding_url">Afbeelding URL</label>
                        <input type="text" name="afbeelding_url" placeholder="Voer de URL van de afbeelding in" required class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">Auto Toevoegen</button>
                </form>
            `;
        });

        // Auto Overzicht weergeven
        document.getElementById('overzicht-link').addEventListener('click', function() {
            document.getElementById('main-content').innerHTML = `
                <h2>Auto Overzicht</h2>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Merk</th>
                            <th>Model</th>
                            <th>Bouwjaar</th>
                            <th>Prijs</th>
                            <th>Afbeelding</th> <!-- Toegevoegd voor het weergeven van de afbeelding -->
                            <th>Aangemaakt op</th>
                            <th>Acties</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($auto = mysqli_fetch_assoc($autos_result)) { ?>
                        <tr>
                            <td><?php echo $auto['id']; ?></td>
                            <td><?php echo $auto['merk']; ?></td>
                            <td><?php echo $auto['model']; ?></td>
                            <td><?php echo $auto['bouwjaar']; ?></td>
                            <td>€<?php echo $auto['prijs']; ?></td>
                            <td><img src="<?php echo $auto['afbeelding_url']; ?>" alt="<?php echo $auto['model']; ?>" style="width:100px;"></td>
                            <td><?php echo $auto['created_at']; ?></td>
                            <td>
                                <a href="edit_car.php?id=<?php echo $auto['id']; ?>" class="btn-edit">Bewerken</a>
                                <a href="delete_car.php?id=<?php echo $auto['id']; ?>" class="btn-delete" onclick="return confirm('Weet je zeker dat je deze auto wilt verwijderen?');">Verwijderen</a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            `;
        });
    </script>

</body>
</html>

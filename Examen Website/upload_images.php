<?php
session_start();
include 'config.php'; // Zorg voor een correcte verbinding met de database

// Foutopsporing inschakelen
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Controleer of er een auto_id is opgegeven in de URL
if (!isset($_GET['id'])) {
    die("Geen auto geselecteerd.");
}

$auto_id = intval($_GET['id']); // Auto ID
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Foto's</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>Upload foto's voor auto ID: <?php echo $auto_id; ?></h1>

        <!-- Controleer of er fouten zijn bij het versturen -->
        <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-danger">
                <?php echo $_GET['error']; ?>
            </div>
        <?php endif; ?>

        <!-- Formulier voor het uploaden van meerdere foto's -->
        <form action="process_upload.php?id=<?php echo $auto_id; ?>" method="POST" enctype="multipart/form-data">
            <label for="images">Selecteer meerdere foto's:</label><br>
            <input type="file" name="images[]" multiple required><br><br>

            <button type="submit" name="upload" class="btn btn-primary">Upload</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
include 'config.php'; // Verbind met de database

if (isset($_GET['id'])) {
    $bericht_id = $_GET['id'];

    $update_query = "UPDATE berichten SET gelezen = 1 WHERE id = $bericht_id";

    if (mysqli_query($conn, $update_query)) {
        header("Location: admin.php?success=Bericht gemarkeerd als gelezen");
    } else {
        header("Location: admin.php?error=Fout bij het markeren van bericht als gelezen");
    }
} else {
    header("Location: admin.php");
}

mysqli_close($conn);
?>

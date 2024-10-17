<?php
include 'config.php'; // Verbind met de database

if (isset($_GET['id'])) {
    $bericht_id = $_GET['id'];

    $delete_query = "DELETE FROM berichten WHERE id = $bericht_id";

    if (mysqli_query($conn, $delete_query)) {
        header("Location: admin.php?success=Bericht succesvol verwijderd");
    } else {
        header("Location: admin.php?error=Fout bij het verwijderen van bericht");
    }
} else {
    header("Location: admin.php");
}

mysqli_close($conn);
?>

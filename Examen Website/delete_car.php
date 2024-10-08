<?php
session_start();
include 'config.php'; // Verbind met de database

// Controleer of de gebruiker is ingelogd en een admin is
if (!isset($_SESSION['user']) || $_SESSION['rol'] != 'admin') {
    header('Location: login.php');
    exit();
}

// Controleer of er een ID is meegegeven
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Verwijder de auto uit de database
    $query = "DELETE FROM cars WHERE id='$id'";
    if (mysqli_query($conn, $query)) {
        header('Location: admin.php'); // Terug naar het overzicht na verwijderen
        exit();
    } else {
        echo "Er is een fout opgetreden bij het verwijderen van de auto.";
    }
} else {
    echo "Geen ID meegegeven.";
}
?>

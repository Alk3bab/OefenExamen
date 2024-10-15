<?php
session_start();
include 'config.php'; // Zorg voor database verbinding

// Controleer of de gebruiker is ingelogd
if (!isset($_SESSION['user']) || $_SESSION['rol'] != 'klant') {
    header('Location: login.php');
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $merk = $_POST['merk'];
    $model = $_POST['model'];
    $bouwjaar = $_POST['bouwjaar'];
    $kilometerstand = $_POST['kilometerstand'];
    $prijs = $_POST['prijs'];
    $afbeelding_url = $_POST['afbeelding_url'];
    $klant_id = $_SESSION['user_id']; // Zorg ervoor dat je de klant ID uit de sessie haalt

    // Voeg de auto toe aan de database
    $query = "INSERT INTO auto_verkoop (merk, model, bouwjaar, kilometerstand, prijs, afbeelding_url, klant_id)
              VALUES ('$merk', '$model', '$bouwjaar', '$kilometerstand', '$prijs', '$afbeelding_url', '$klant_id')";
    
    if (mysqli_query($conn, $query)) {
        echo "Auto succesvol toegevoegd!";
        header('Location: klant.php');
    } else {
        echo "Er is een fout opgetreden: " . mysqli_error($conn);
    }
}
?>

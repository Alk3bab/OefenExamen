<?php
session_start();
include 'config.php'; // Zorg ervoor dat je een correcte databaseverbinding hebt

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $auto_id = $_POST['auto_id'];
    $naam = htmlspecialchars($_POST['naam']);
    $email = htmlspecialchars($_POST['email']);
    $bericht = htmlspecialchars($_POST['bericht']);

    // Je kunt de reserveringsgegevens hier verwerken (bijv. opslaan in de database of via e-mail verzenden)
    // Stuur een bevestiging naar de gebruiker of admin
    // Hier een voorbeeld voor het versturen van een e-mail:

    $to = "jouw-email@domein.com"; // Admin e-mailadres
    $subject = "Nieuwe reservering voor auto ID: $auto_id";
    $body = "Naam: $naam\nE-mail: $email\n\nBericht:\n$bericht";
    $headers = "From: $email";

    if (mail($to, $subject, $body, $headers)) {
        echo "Reservering succesvol verzonden!";
    } else {
        echo "Fout bij het verzenden van de reservering.";
    }
} else {
    header('Location: occasions.php');
}

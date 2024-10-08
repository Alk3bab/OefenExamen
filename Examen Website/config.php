<?php
$servername = "localhost";
$username = "root";  // Standaard voor XAMPP
$password = "";      // Standaard leeg voor XAMPP
$dbname = "premiumwagens_db"; // Jouw database naam

// Verbinding maken met de database
$conn = new mysqli($servername, $username, $password, $dbname);

// Controleer de verbinding
if ($conn->connect_error) {
    die("Verbinding mislukt: " . $conn->connect_error);
}

// Stel de juiste tekenset in voor de databaseverbinding (voor UTF-8)
if (!$conn->set_charset("utf8")) {
    die("Fout bij instellen van UTF-8 karakterset: " . $conn->error);
}




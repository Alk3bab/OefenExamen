<?php
session_start();
session_destroy(); // Beëindigt de sessie en logt de gebruiker uit
header("Location: login.php"); // Stuur de gebruiker terug naar de loginpagina
exit();
?>

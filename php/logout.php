<?php
session_start(); // Démarre la session
// Détruit toutes les sessions
$_SESSION = array(); // Vide le tableau de session
session_destroy(); // Détruit la session

// Redirige vers la page d'accueil ou de connexion
header("Location: connexion.html");
exit;
?>

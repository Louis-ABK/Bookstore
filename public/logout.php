<?php
// public/logout.php
session_start();        // Démarrer la session (si ce n'est pas déjà fait)
session_unset();        // Supprimer toutes les variables de session
session_destroy();      // Détruire la session

// Rediriger l'utilisateur vers la page de connexion
header("Location: login.php");
exit;
?>
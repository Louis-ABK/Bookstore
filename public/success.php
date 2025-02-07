<?php
session_start();
// Suppression du panier après validation de la commande
unset($_SESSION['cart']);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Commande Validée</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <?php include '../includes/header.php'; ?>

    <div class="container">
        <h2>Commande Validée !</h2>
        <p>Votre commande a été validée avec succès  <?= htmlspecialchars($_SESSION['user']['name']); ?> !</p>
        <a href="books.php" class="btn">Retour à la boutique</a>
    </div>

    <?php include '../includes/footer.php'; ?>
</body>
</html>
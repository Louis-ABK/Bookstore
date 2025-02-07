<?php
// public/index.php
session_start();
require_once '../includes/db.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Accueil - Ma Bookstore</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <?php include_once '../includes/header.php'; ?>

    <div class="container home">
        <!-- Section d'accueil avec un message de bienvenue -->
        <section class="hero">
            <h1>Bienvenue sur votre Bookstore</h1>
            <p>Découvrez une large sélection de livres, des best-sellers aux classiques incontournables.</p>
     <!--       <div class="cta-buttons">
                <a href="books.php" class="btn">Découvrir nos livres</a>
                <?php if(isset($_SESSION['user'])): ?>
                    <a href="cart.php" class="btn">Voir mon panier</a>
                <?php else: ?>
                    <a href="login.php" class="btn">Se connecter</a>
                <?php endif; ?>
            </div> --> 
        </section>

        <!-- Section présentant quelques points forts -->
        <section class="features">
            <div class="feature">
                <h3>Large Sélection</h3>
                <p>Des milliers de titres pour tous les goûts et toutes les envies.</p>
            </div>
            <div class="feature">
                <h3>Qualité Garantie</h3>
                <p>Des livres neufs et d'occasion rigoureusement sélectionnés pour vous.</p>
            </div>
            <div class="feature">
                <h3>Livraison Rapide</h3>
                <p>Recevez vos commandes en un temps record grâce à nos partenaires logistiques.</p>
            </div>
        </section>

        <!-- Section de témoignages ou d'actualités (optionnel) -->
        <section class="testimonials">
            <h2>Commentaires</h2>
            <div class="testimonial">
                <p>"Un service impeccable et une vaste sélection de livres !"</p>
                <cite>- Marie D.</cite>
            </div>
            <div class="testimonial">
                <p>"Très agréable a mon gout !"</p>
                <cite>- Dan Mintsa</cite>
            </div>
            <div class="testimonial">
                <p>"Ma Bookstore est devenue ma référence pour trouver les dernières nouveautés."</p>
                <cite>- Victor De Vinci</Mark></cite>
            </div>
            <div class="testimonial">
                <p>"Plus une journée ne passe sans me rendre sur mon espace de lecture.<p>
                <cite>- Noellia Sia</cite>
            </div>
        </section>
    </div>

    <?php include_once '../includes/footer.php'; ?>
</body>
</html>
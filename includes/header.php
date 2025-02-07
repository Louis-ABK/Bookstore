<header>
    <nav>
        <ul>
            <li><a href="../public/index.php">Accueil</a></li>
            <li><a href="../public/books.php">Livres</a></li>
            <?php if (isset($_SESSION['user'])): ?>
                <li><a href="../public/cart.php">Panier</a></li>
                <li><a href="../public/logout.php">Déconnexion</a></li>
                <li>Bonjour, <?= htmlspecialchars($_SESSION['user']['name']); ?></li>
                <?php else: ?>
                <li><a href="../public/login.php">Connexion</a></li>
                <li><a href="../public/register.php">Inscription</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>
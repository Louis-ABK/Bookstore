
<?php
session_start();
require_once '../includes/db.php';

$stmt = $pdo->query("SELECT * FROM books");
$books = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Livres disponibles</title>
  <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
  <?php include '../includes/header.php'; ?>

  <div class="container">
    <h2>Nos Livres</h2>
    <div class="books-grid">
      <?php foreach ($books as $book): ?>
        <div class="book-card">
          <img src="<?= htmlspecialchars($book['image_url']); ?>" alt="<?= htmlspecialchars($book['title']); ?>">
          <h3><?= htmlspecialchars($book['title']); ?></h3>
          <p>Auteur : <?= htmlspecialchars($book['author']); ?></p>
          <p>Catégorie : <?= htmlspecialchars($book['category']); ?></p>
          <p>Prix : <?= number_format($book['price']); ?> Francs CFA</p>
          <form action="cart.php" method="post">
            <input type="hidden" name="book_id" value="<?= $book['id']; ?>">
            <button type="submit">Ajouter au panier</button>
          </form>
        </div>
      <?php endforeach; ?>
    </div>
  </div>

  <?php include '../includes/footer.php'; ?>
</body>
</html>
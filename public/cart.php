<?php
session_start();
require_once '../includes/db.php';

// Ajout d'un livre au panier
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['book_id']) && !isset($_POST['update_cart'])) {
    $book_id = intval($_POST['book_id']);

    // Initialiser le panier s'il n'existe pas
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }
    
    // Si le livre est déjà dans le panier, augmenter la quantité sinon l'ajouter
    if (isset($_SESSION['cart'][$book_id])) {
        $_SESSION['cart'][$book_id]++;
    } else {
        $_SESSION['cart'][$book_id] = 1;
    }
    
    // Rediriger pour éviter le re-posting du formulaire
    header("Location: cart.php");
    exit;
}

// Mise à jour du panier (modification des quantités)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_cart'])) {
    foreach ($_POST['quantities'] as $book_id => $quantity) {
        $book_id = intval($book_id);
        $quantity = intval($quantity);
        if ($quantity <= 0) {
            unset($_SESSION['cart'][$book_id]);
        } else {
            $_SESSION['cart'][$book_id] = $quantity;
        }
    }
    header("Location: cart.php");
    exit;
}

// Récupération des détails des livres présents dans le panier
$cart_items = [];
$total = 0.0;

if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    $placeholders = implode(',', array_fill(0, count($_SESSION['cart']), '?'));
    $stmt = $pdo->prepare("SELECT * FROM books WHERE id IN ($placeholders)");
    $stmt->execute(array_keys($_SESSION['cart']));
    $books = $stmt->fetchAll();
    
    foreach ($books as $book) {
        $book_id = $book['id'];
        $quantity = $_SESSION['cart'][$book_id];
        $subtotal = $book['price'] * $quantity;
        $total += $subtotal;
        $cart_items[] = [
            'id'        => $book_id,
            'title'     => $book['title'],
            'author'    => $book['author'],
            'price'     => $book['price'],
            'quantity'  => $quantity,
            'subtotal'  => $subtotal,
            'image_url' => $book['image_url']
        ];
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Votre Panier</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <?php include '../includes/header.php'; ?>

    <div class="container">
        <h2>Mon Panier</h2>
        
        <?php if (empty($cart_items)): ?>
            <p>Votre panier est vide  <?= htmlspecialchars($_SESSION['user']['name']); ?> !</p>
        <?php else: ?>
            <form action="cart.php" method="post">
                <table>
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Titre</th>
                            <th>Prix</th>
                            <th>Quantité</th>
                            <th>Sous-total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($cart_items as $item): ?>
                            <tr>
                                <td>
                                    <img src="<?= htmlspecialchars($item['image_url']); ?>" alt="<?= htmlspecialchars($item['title']); ?>" width="50">
                                </td>
                                <td><?= htmlspecialchars($item['title']); ?></td>
                                <td><?= number_format($item['price']); ?> Francs CFA</td>
                                <td>
                                    <input type="number" name="quantities[<?= $item['id']; ?>]" value="<?= $item['quantity']; ?>" min="0">
                                </td>
                                <td><?= number_format($item['subtotal']); ?> Francs CFA</td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <p>Total : <strong><?= number_format($total, 2); ?> Francs CFA</strong></p>
                <button type="submit" name="update_cart">Mettre à jour mon panier</button>
                <!-- Bouton pour valider la commande -->
                <a href="success.php" class="btn btn-success" style="text-align:center">Valider ma commande</a>
            </form>
        <?php endif; ?>
    </div>

    <?php include '../includes/footer.php'; ?>
</body>
</html>
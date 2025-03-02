

<?php if (!isset($_SESSION['user_id'])): ?>
    <p style="color: red;">⚠️ Vous devez être connecté pour voir votre panier.</p>
    <a href="index.php?action=login" class="auth-btn">🔑 Se connecter</a>
    <a href="index.php?action=register" class="auth-btn">📝 Créer un compte</a>
<?php else: ?>
    <h1>Votre Panier</h1>
    <?php if (!empty($_SESSION['cart'])): ?>
        <ul>
            <?php foreach ($_SESSION['cart'] as $filmId => $quantity): ?>
                <li>
                    Film ID: <?php echo $filmId; ?> - Quantité: <?php echo $quantity; ?>
                    <a href="index.php?action=removeFromCart&id=<?php echo $filmId; ?>">🗑 Supprimer</a>
                </li>
            <?php endforeach; ?>
        </ul>
        <a href="index.php?action=checkout">✅ Valider la commande</a>
    <?php else: ?>
        <p>Votre panier est vide.</p>
    <?php endif; ?>
<?php endif; ?>


<?php include 'views/header.php'; ?>

<?php if (!isset($_SESSION['user_id'])): ?>
    <p style="color: red;">⚠️ Vous devez être connecté pour voir votre panier.</p>
    <a href="index.php?action=login" class="auth-btn">🔑 Se connecter</a>
    <a href="index.php?action=register" class="auth-btn">📝 Créer un compte</a>
<?php else: ?>
    <h1>Votre Panier</h1>
    <?php if (!empty($films)): ?>
        <ul>
            <?php foreach ($films as $film): ?>
                <li>
                    <img src="https://image.tmdb.org/t/p/w500<?php echo $film['poster_path']; ?>" alt="<?php echo $film['title']; ?>" width="100">
                    <h3><?php echo $film['title']; ?></h3>
                    <p>Prix : <?php echo $film['prix']; ?> €</p>
                    <p>Quantité : <?php echo $film['quantity']; ?></p>
                    <a href="index.php?action=removeFromCart&id=<?php echo $film['id']; ?>">🗑 Supprimer</a>
                </li>
            <?php endforeach; ?>
        </ul>
        <a href="index.php?action=checkout">✅ Valider la commande</a>
    <?php else: ?>
        <p>Votre panier est vide.</p>
    <?php endif; ?>
<?php endif; ?>
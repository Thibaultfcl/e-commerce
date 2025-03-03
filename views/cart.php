<?php include 'views/header.php'; ?>

<section class="cart-section">
    <h1>Votre Panier</h1>
    <?php if (!empty($films)): ?>
        <ul class="cart-list">
            <?php foreach ($films as $film): ?>
                <li class="cart-item">
                    <img src="https://image.tmdb.org/t/p/w500<?php echo $film['poster_path']; ?>" alt="<?php echo $film['title']; ?>" class="cart-item-img">
                    <div class="cart-item-details">
                        <h3><?php echo $film['title']; ?></h3>
                        <p>Prix : <?php echo $film['prix']; ?> €</p>
                        <p>Quantité : <?php echo $film['quantity']; ?></p>
                        <a href="index.php?action=removeFromCart&id=<?php echo $film['id']; ?>" class="remove-btn">🗑 Supprimer</a>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
        <div class="cart-actions">
            <a href="index.php?action=checkout" class="checkout-btn">✅ Valider la commande</a>
            <a href="index.php?action=orderHistory" class="history-btn">🛒 Historique de commandes</a>
        </div>
    <?php else: ?>
        <p>Votre panier est vide.</p>
        <a href="index.php?action=orderHistory" class="history-btn">🛒 Historique de commandes</a>
    <?php endif; ?>
</section>
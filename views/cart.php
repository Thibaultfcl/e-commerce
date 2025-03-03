<?php include 'views/header.php'; ?>


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
        <a href="index.php?action=orderHistory">🗑 Ancienne commande</a>
    <?php else: ?>
        <p>Votre panier est vide.</p>
        <a href="index.php?action=orderHistory">🗑 Ancienne commande</a>
    <?php endif; ?>

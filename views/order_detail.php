<?php include 'views/header.php'; ?>

<!-- views/order_detail.php -->
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Détails de la Commande</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>

<body>
    <section class="order-detail-section">
        <h1>Détails de la Commande #<?php echo htmlspecialchars($_GET['id']); ?></h1>
        <ul class="order-detail-list">
            <?php foreach ($orderDetails as $detail): ?>
                <li class="order-detail-item">
                    <img src="https://image.tmdb.org/t/p/w500<?php echo $detail['film']['poster_path']; ?>" alt="<?php echo $detail['film']['title']; ?>" class="order-detail-img">
                    <div class="order-detail-info">
                        <h3><?php echo $detail['film']['title']; ?></h3>
                        <p>Prix : <?php echo $detail['price']; ?> €</p>
                        <p>Quantité : <?php echo $detail['quantity']; ?></p>
                        <p>Description : <?php echo $detail['film']['overview']; ?></p>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
        <a href="index.php?action=orderHistory" class="back-to-history-btn">Retour à l'historique des commandes</a>
    </section>
</body>

</html>
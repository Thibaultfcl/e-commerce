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
    <h1>Détails de la Commande #<?php echo htmlspecialchars($_GET['id']); ?></h1>
    <ul>
        <?php foreach ($orderDetails as $detail): ?>
            <li>
                <img src="https://image.tmdb.org/t/p/w500<?php echo $detail['film']['poster_path']; ?>" alt="<?php echo $detail['film']['title']; ?>" width="100">
                <h3><?php echo $detail['film']['title']; ?></h3>
                <p>Prix : <?php echo $detail['price']; ?> €</p>
                <p>Quantité : <?php echo $detail['quantity']; ?></p>
                <p>Description : <?php echo $detail['film']['overview']; ?></p>
            </li>
        <?php endforeach; ?>
    </ul>
    <a href="index.php?action=orderHistory">Retour à l'historique des commandes</a>
</body>

</html>
<?php include 'views/header.php'; ?>

<!-- views/order_history.php -->
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Historique des Achats</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>

<body>
    <section class="order-history-section">
        <h1>Historique des Achats</h1>
        <ul class="order-list">
            <?php foreach ($orders as $order): ?>
                <li class="order-item">
                    <a href="index.php?action=orderDetail&id=<?php echo $order['id']; ?>" class="order-link">
                        Commande #<?php echo $order['id']; ?> - Total : <?php echo $order['total_price']; ?> € - Date : <?php echo $order['created_at']; ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </section>
</body>

</html>
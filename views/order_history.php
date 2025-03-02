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
    <h1>Historique des Achats</h1>
    <ul>
        <?php foreach ($orders as $order): ?>
            <li>
                Commande #<?php echo $order['id']; ?> - Total : <?php echo $order['total']; ?> € - Date : <?php echo $order['date']; ?>
            </li>
        <?php endforeach; ?>
    </ul>
</body>

</html>
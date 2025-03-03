<?php include 'views/header.php'; ?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Payment</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>

<body>
    <h1>Coordonnées Bancaires</h1>
    <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>

    <form action="index.php?action=processPayment" method="POST">
        <label>Nom sur la carte:</label>
        <input type="text" name="card_name" required><br>

        <label>Numéro de carte:</label>
        <input type="text" name="card_number" required><br>

        <label>Date d'expiration:</label>
        <input type="text" name="expiry_date" required><br>

        <label>CVV:</label>
        <input type="text" name="cvv" required><br>

        <button type="submit">Valider le paiement</button>
    </form>
</body>

</html>
<?php include 'views/header.php'; ?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Payment</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>

<body>
    <section class="payment-section">
        <h1>Coordonnées Bancaires</h1>
        <?php if (isset($error)) echo "<p class='error-msg'>$error</p>"; ?>

        <form action="index.php?action=processPayment" method="POST" class="payment-form">
            <label>Nom sur la carte:</label>
            <input type="text" name="card_name" required class="payment-input"><br>

            <label>Numéro de carte:</label>
            <input type="text" name="card_number" required class="payment-input"><br>

            <label>Date d'expiration:</label>
            <input type="text" name="expiry_date" required class="payment-input"><br>

            <label>CVV:</label>
            <input type="text" name="cvv" required class="payment-input"><br>

            <button type="submit" class="payment-btn">Valider le paiement</button>
        </form>
    </section>
</body>

</html>
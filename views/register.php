<?php include 'views/header.php'; ?>

<!-- views/register.php -->
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>

<body>
    <section class="register-section">
        <h1>Inscription</h1>
        <?php if (isset($error)) echo "<p class='error-msg'>$error</p>"; ?>

        <form action="index.php?action=register" method="POST" class="register-form">
            <label>Nom:</label>
            <input type="text" name="nom" required class="register-input"><br>

            <label>Email:</label>
            <input type="email" name="email" required class="register-input"><br>

            <label>Mot de passe:</label>
            <input type="password" name="mot_de_passe" required class="register-input"><br>

            <button type="submit" class="register-btn">S'inscrire</button>
        </form>

        <p>Déjà inscrit ? <a href="index.php?action=login" class="login-link">Connectez-vous</a></p>
    </section>
</body>

</html>
<?php include 'views/header.php'; ?>

<!-- views/login.php -->
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>

<body>
    <section class="login-section">
        <h1>Connexion</h1>
        <?php if (isset($error)) echo "<p class='error-msg'>$error</p>"; ?>

        <form action="index.php?action=login" method="POST" class="login-form">
            <label>Email:</label>
            <input type="email" name="email" required class="login-input"><br>

            <label>Mot de passe:</label>
            <input type="password" name="mot_de_passe" required class="login-input"><br>

            <button type="submit" class="login-btn">Se connecter</button>
        </form>

        <p>Pas encore inscrit ? <a href="index.php?action=register" class="register-link">Créez un compte</a></p>
    </section>
</body>

</html>
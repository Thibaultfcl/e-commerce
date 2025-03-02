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
    <h1>Connexion</h1>
    <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>

    <form action="index.php?action=login" method="POST">
        <label>Email:</label>
        <input type="email" name="email" required><br>

        <label>Mot de passe:</label>
        <input type="password" name="mot_de_passe" required><br>

        <button type="submit">Se connecter</button>
    </form>

    <p>Pas encore inscrit ? <a href="index.php?action=register">Créez un compte</a></p>
</body>

</html>
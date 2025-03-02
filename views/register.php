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
<h1>Inscription</h1>
<?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>

<form action="index.php?action=register" method="POST">
    <label>Nom:</label>
    <input type="text" name="nom" required><br>

    <label>Email:</label>
    <input type="email" name="email" required><br>

    <label>Mot de passe:</label>
    <input type="password" name="mot_de_passe" required><br>

    <button type="submit">S'inscrire</button>
</form>

<p>Déjà inscrit ? <a href="index.php?action=login">Connectez-vous</a></p>
</body>
</html>

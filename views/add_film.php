<?php include 'views/header.php'; ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un Film</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
<h1>Ajouter un Film</h1>

<form action="index.php?action=addFilm" method="POST">
    <label>Titre:</label>
    <input type="text" name="titre" required><br>

    <label>Réalisateur:</label>
    <input type="text" name="realisateur" required><br>

    <label>Catégorie ID:</label>
    <input type="number" name="categorie_id" required><br>

    <label>Prix:</label>
    <input type="number" name="prix" required><br>

    <button type="submit">Ajouter</button>
</form>

<a href="index.php?action=adminDashboard">Retour au tableau de bord</a>
</body>
</html>

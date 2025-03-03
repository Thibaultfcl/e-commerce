<?php include 'views/header.php'; ?>

<!-- views/admin_dashboard.php -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Tableau de Bord Administrateur</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
<h1>Tableau de Bord Administrateur</h1>
<a href="index.php?action=adminLogout">🚪 Se déconnecter</a>

<h2>Liste des Films</h2>
<ul>
    <?php foreach ($films as $film) : ?>
        <li>
            <h3><?php echo $film['titre']; ?></h3>
            <p>Prix : <?php echo $film['prix']; ?> €</p>
        </li>
    <?php endforeach; ?>
</ul>
<a href="index.php?action=addFilm">Ajouter un nouveau film</a>
</body>
</html>
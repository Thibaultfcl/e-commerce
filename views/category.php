<?php include 'views/header.php'; ?>

<!-- views/category.php -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Films par Catégorie</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
<a href="index.php" class="back-btn">🏠 Retour à l'accueil</a>

<h1>Films de la catégorie : <?php echo htmlspecialchars($category['nom']); ?></h1>

<ul>
    <?php if (!empty($films)): ?>
        <?php foreach ($films as $film) : ?>
            <li>
                <img src="public/images/<?php echo $film['image']; ?>" alt="<?php echo $film['titre']; ?>" width="150">
                <h3><?php echo $film['titre']; ?></h3>
                <p>Réalisateur : <?php echo $film['realisateur']; ?></p>
                <p>Prix : <?php echo $film['prix']; ?> €</p>
                <a href="index.php?action=filmDetail&id=<?php echo $film['id']; ?>">Voir les détails</a>
            </li>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Aucun film trouvé dans cette catégorie.</p>
    <?php endif; ?>
</ul>
</body>
</html>

<?php include 'views/header.php'; ?>

<!-- views/film_detail.php -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détail du Film</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
    <h1><?php echo $film['titre']; ?></h1>
    <img src="public/images/<?php echo $film['image']; ?>" alt="<?php echo $film['titre']; ?>">
    <p><strong>Réalisateur :</strong> <?php echo $film['realisateur']; ?></p>
    <p><strong>Acteurs :</strong> <?php echo $film['acteurs']; ?></p>
    <p><strong>Prix :</strong> <?php echo $film['prix']; ?> €</p>
    <a href="index.php?action=addToCart&id=<?php echo $film['id']; ?>">Ajouter au panier</a>
    <h2>D'autres films du même réalisateur</h2>
    <ul>
        <?php foreach ($otherFilms as $other) : ?>
            <li>
                <a href="index.php?action=filmDetail&id=<?php echo $other['id']; ?>">
                    <?php echo $other['titre']; ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>

<?php include 'views/header.php'; ?>

<!-- views/search_results.php -->
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultats de la recherche</title>
    <link rel="stylesheet" href="public/css/style.css">

</head>

<body>
    <h1>🔍 Résultats de la recherche</h1>

    <?php if (!empty($films)): ?>
        <ul>
            <?php foreach ($films as $film) : ?>
                <li>
                    <img src="public/images/<?php echo $film['image']; ?>" alt="<?php echo $film['titre']; ?>" width="100">
                    <h3><?php echo $film['titre']; ?></h3>
                    <p>Réalisateur : <?php echo $film['realisateur']; ?></p>
                    <p>Prix : <?php echo $film['prix']; ?> €</p>
                    <a href="index.php?action=filmDetail&id=<?php echo $film['id']; ?>">Voir les détails</a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p> Aucun film trouvé pour "<?php echo htmlspecialchars($_GET['query']); ?>"</p>
    <?php endif; ?>

    <a href="index.php">🏠 Retour à l'accueil</a>

</body>

</html>
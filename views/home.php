<?php include 'views/header.php'; ?>

<!-- views/home.php -->
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - Internet Movies DataBase</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>

<body>
    <section>
        <h2>Derniers films ajoutés</h2>
        <div class="film-grid">
            <?php foreach ($films as $film) : ?>
                <div class="film-item">
                    <a href="index.php?action=filmDetail&id=<?php echo $film['id']; ?>">
                        <img src="https://image.tmdb.org/t/p/w500<?php echo $film['poster_path']; ?>" alt="<?php echo $film['title']; ?>">
                        <h3><?php echo $film['title']; ?></h3>
                        <p>Prix : <?php echo $film['prix']; ?> €</p>
                    </a>
                    <a href="index.php?action=addToCart&id=<?php echo $film['id']; ?>">Ajouter au panier</a>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
</body>

</html>
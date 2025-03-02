<?php include 'views/header.php'; ?>

<!-- views/film_detail.php -->
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détail du Film</title>
    <link rel="stylesheet" href="public/css/style.css">
    <style>
        .film-detail {
            text-align: center;
        }
        .film-detail img {
            max-width: 300px;
            height: auto;
        }
        .film-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }
        .film-item {
            flex: 1 1 calc(20% - 20px); /* 5 films par ligne */
            box-sizing: border-box;
            padding: 10px;
            border: 1px solid #ccc;
            text-align: center;
        }
        .film-item img {
            max-width: 100px;
            height: auto;
        }
        .actor-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }
        .actor-item {
            flex: 1 1 calc(20% - 20px); /* 5 acteurs par ligne */
            box-sizing: border-box;
            padding: 10px;
            border: 1px solid #ccc;
            text-align: center;
        }
        .actor-item img {
            max-width: 100px;
            height: auto;
        }
    </style>
</head>

<body>
    <h1>Détail du Film</h1>
    <div class="film-detail">
        <h2><?php echo $film['title'] ?? 'Titre non disponible'; ?></h2>
        <img src="https://image.tmdb.org/t/p/w500<?php echo $film['poster_path'] ?? ''; ?>" alt="<?php echo $film['title'] ?? 'Titre non disponible'; ?>">
        <p>Réalisateur : <?php echo $film['director'] ?? 'Non disponible'; ?></p>
        <p>Synopsis : <?php echo $film['overview'] ?? 'Non disponible'; ?></p>
        <p>Date de sortie : <?php echo $film['release_date'] ?? 'Non disponible'; ?></p>
        <p>Note : <?php echo $film['vote_average'] ?? 'Non disponible'; ?>/10</p>
        <p>Prix : <?php echo $film['prix'] ?? 'Non disponible'; ?> €</p>
        <p>Acteurs :</p>
        <div class="actor-grid">
            <?php foreach (array_slice($film['cast'], 0, 10) as $actor) : ?>
                <div class="actor-item">
                    <a href="index.php?action=actorDetail&id=<?php echo $actor['id']; ?>">
                        <img src="https://image.tmdb.org/t/p/w500<?php echo $actor['profile_path'] ?? ''; ?>" alt="<?php echo $actor['name']; ?>">
                        <p><?php echo $actor['name']; ?></p>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
        <a href="index.php?action=addToCart&id=<?php echo $film['id']; ?>">Ajouter au panier</a>
    </div>
    <h3>D'autres films du même réalisateur</h3>
    <div class="film-grid">
        <?php foreach ($otherFilms as $otherFilm) : ?>
            <div class="film-item">
                <a href="index.php?action=filmDetail&id=<?php echo $otherFilm['id']; ?>">
                    <h4><?php echo $otherFilm['title'] ?? 'Titre non disponible'; ?></h4>
                    <img src="https://image.tmdb.org/t/p/w500<?php echo $otherFilm['poster_path'] ?? ''; ?>" alt="<?php echo $otherFilm['title'] ?? 'Titre non disponible'; ?>" width="100">
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</body>

</html>
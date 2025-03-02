<?php include 'views/header.php'; ?>

<!-- views/actor_detail.php -->
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détail de l'Acteur</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>

<body>
    <div class="actor-detail">
        <h2><?php echo $actor['name'] ?? 'Nom non disponible'; ?></h2>
        <img src="https://image.tmdb.org/t/p/w500<?php echo $actor['profile_path'] ?? ''; ?>" alt="<?php echo $actor['name'] ?? 'Nom non disponible'; ?>">
        <p>Date de naissance : <?php echo $actor['birthday'] ?? 'Non disponible'; ?></p>
        <p>Lieu de naissance : <?php echo $actor['place_of_birth'] ?? 'Non disponible'; ?></p>
        <p>Films :</p>
        <div class="film-grid">
            <?php if (isset($actor['filmography']) && is_array($actor['filmography'])) : ?>
                <?php foreach ($actor['filmography'] as $film) : ?>
                    <div class="film-item">
                        <a href="index.php?action=filmDetail&id=<?php echo $film['id']; ?>">
                            <h4><?php echo $film['title'] ?? 'Titre non disponible'; ?></h4>
                            <img src="https://image.tmdb.org/t/p/w500<?php echo $film['poster_path'] ?? ''; ?>" alt="<?php echo $film['title'] ?? 'Titre non disponible'; ?>" width="100">
                        </a>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <p>Aucun film disponible.</p>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>

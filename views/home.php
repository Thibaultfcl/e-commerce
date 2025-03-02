<?php include 'views/header.php'; ?>

<!-- views/home.php -->
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - Internet Movies DataBase</title>
    <link rel="stylesheet" href="public/css/style.css">
    <style>
        .film-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }
        .film-item {
            flex: 1 1 calc(20% - 20px); /* 5 films par ligne */
            box-sizing: border-box;
            padding: 10px;
            border: 1px solid #ccc;
            text-align: center;
        }
        .film-item img {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>

<body>
    <header>
        <h1>Bienvenue sur Internet Movies Database 🎬</h1>
        <p>Explorez notre vaste collection de films d'action et de drame ! Ajoutez vos favoris au panier et passez commande en toute simplicité.</p>

        <!-- Boutons vers les catégories -->
        <div>
            <a href="index.php?action=filmsByCategory&cat=1" class="category-btn">🎬 Films d'Action</a>
            <a href="index.php?action=filmsByCategory&cat=2" class="category-btn">🎭 Films Dramatiques</a>
        </div>

        <!-- Formulaire de recherche -->
        <form action="index.php?action=search" method="GET">
            <input type="text" name="query" placeholder="Rechercher par titre ou réalisateur">
            <button type="submit">Rechercher</button>
        </form>
    </header>
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
    <div class="cart-menu">
        <?php if (isset($_SESSION['user_id'])): ?>
            <a href="index.php?action=showCart" class="cart-btn">🛒 Voir mon panier</a>
        <?php else: ?>
            <p style="color: red;">⚠️ Connectez-vous pour voir votre panier.</p>
        <?php endif; ?>
    </div>
    <form action="index.php" method="GET">
        <input type="hidden" name="action" value="search">
        <input type="text" name="query" placeholder="Rechercher un film ou un réalisateur..." required>
        <button type="submit">🔍 Rechercher</button>
    </form>
</body>

</html>
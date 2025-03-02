<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Film&Chill</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>

<body>
    <header>
        <nav class="navbar">
            <div class="site-name-container">
                <a href="index.php" class="site-name">Film&Chill</a>
            </div>
            <div class="auth-links">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <span>Bienvenue, <?php echo htmlspecialchars($_SESSION['user_name']); ?> !</span>
                    <a href="index.php?action=logout">Se déconnecter</a>
                <?php else: ?>
                    <a href="index.php?action=login">Se connecter</a>
                    <a href="index.php?action=register">Créer un compte</a>
                <?php endif; ?>
            </div>
        </nav>
        <form action="index.php" method="GET" class="search-form">
            <input type="hidden" name="action" value="search">
            <input type="text" name="query" placeholder="Rechercher par titre ou réalisateur">
            <button type="submit">Rechercher</button>
        </form>
    </header>
</body>

</html>
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
                    <div class="user-info">
                        <span>Bienvenue, <?php echo htmlspecialchars($_SESSION['user_name']); ?> !</span>
                        <a href="index.php?action=logout">Se déconnecter</a>
                    </div>
                    <div class="cart-container">
                        <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] === 'admin'): ?>
                            <a href="index.php?action=adminDashboard" class="admin-btn">⚙️ Admin Panel</a>
                        <?php endif; ?>
                        <a href="index.php?action=showCart" class="cart-btn">🛒 Voir mon panier</a>
                    </div>
                <?php else: ?>
                    <a href="index.php?action=login">Se connecter</a>
                    <a href="index.php?action=register">Créer un compte</a>
                <?php endif; ?>
            </div>
        </nav>
        <form action="index.php" method="GET" class="search-form">
            <input type="hidden" name="action" value="search">
            <input type="text" name="query" placeholder="Rechercher par titre" class="search-input">
            <button type="submit" class="search-button">Rechercher</button>
        </form>
    </header>
</body>

</html>
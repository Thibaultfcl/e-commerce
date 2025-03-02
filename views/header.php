<header>
    <nav>
        <?php if (isset($_SESSION['user_id'])): ?>
            <span>Bienvenue, <?php echo htmlspecialchars($_SESSION['user_name']); ?> !</span>
            <a href="index.php?action=logout">🚪 Se déconnecter</a>
        <?php else: ?>
            <a href="index.php?action=login">🔑 Se connecter</a>
            <a href="index.php?action=register">📝 Créer un compte</a>
        <?php endif; ?>
    </nav>
</header>
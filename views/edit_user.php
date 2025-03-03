<?php include 'views/header.php'; ?>

<h1>Modifier l'utilisateur</h1>

<?php if (isset($error)): ?>
    <p style="color: red;"><?php echo $error; ?></p>
<?php endif; ?>

<form action="index.php?action=editUser" method="POST">
    <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
    <div>
        <label for="username">Nom :</label>
        <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>
    </div>
    <div>
        <label for="email">Email :</label>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
    </div>
    <button type="submit">Enregistrer</button>
</form>
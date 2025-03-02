<?php include 'views/header.php'; ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier un Film</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
<h1>Modifier un Film</h1>

<form action="index.php?action=editFilm&id=<?php echo $film['id']; ?>" method="POST">
    <label>Titre:</label>
    <input type="text" name="titre" value="<?php echo $film['titre']; ?>" required><br>

    <label>Réalisateur:</label>
    <input type="text" name="realisateur" value="<?php echo $film['realisateur']; ?>" required><br>

    <label>Catégorie ID:</label>
    <input type="number" name="categorie_id" value="<?php echo $film['categorie_id']; ?>" required><br>

    <label>Prix:</label>
    <input type="number" name="prix" value="<?php echo $film['prix']; ?>" required><br>

    <button type="submit">Modifier</button>
</form>

<a href="index.php?action=adminDashboard">Retour au tableau de bord</a>
</body>
</html>

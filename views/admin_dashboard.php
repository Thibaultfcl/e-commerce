<?php include 'views/header.php'; ?>

<h1>Tableau de bord de l'administrateur</h1>

<h2>Commandes récentes</h2>
<table class="admin-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Utilisateur</th>
            <th>Total</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($orders as $order): ?>
            <tr>
                <td><?php echo $order['id']; ?></td>
                <td><?php echo $order['user_name']; ?></td>
                <td><?php echo $order['total_price']; ?> €</td>
                <td><?php echo $order['created_at']; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<h2>Utilisateurs</h2>
<table class="admin-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Email</th>
            <th>Date d'inscription</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?php echo $user['id']; ?></td>
                <td><?php echo $user['username']; ?></td>
                <td><?php echo $user['email']; ?></td>
                <td><?php echo $user['created_at']; ?></td>
                <td><a href="index.php?action=editUser&id=<?php echo $user['id']; ?>">Modifier</a></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
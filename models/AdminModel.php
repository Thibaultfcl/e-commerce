<?php
// models/AdminModel.php

class AdminModel
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    // Récupère toutes les commandes avec le nom de l'utilisateur
    public function getAllOrders()
    {
        $stmt = $this->pdo->query("
            SELECT command.id, users.username AS user_name, command.total_price, command.created_at
            FROM command
            JOIN users ON command.user_id = users.id
            ORDER BY command.created_at DESC
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Récupère tous les utilisateurs sauf les administrateurs
    public function getAllUsers()
    {
        $stmt = $this->pdo->query("SELECT * FROM users WHERE role != 'admin' ORDER BY created_at DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Récupère un utilisateur par son ID
    public function getUserById($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Met à jour un utilisateur
    public function updateUser($id, $username, $email)
    {
        $stmt = $this->pdo->prepare("UPDATE users SET username = :username, email = :email WHERE id = :id");
        $stmt->execute(['username' => $username, 'email' => $email, 'id' => $id]);
    }
}

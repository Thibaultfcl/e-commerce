<?php
// controllers/AdminController.php

require_once 'models/AdminModel.php';
session_start();

class AdminController
{
    private $pdo;
    private $apiKey;

    public function __construct($pdo, $apiKey)
    {
        $this->pdo = $pdo;
        $this->apiKey = $apiKey;
    }

    // Affiche le tableau de bord de l'administrateur
    public function dashboard()
    {
        // Vérifier si l'utilisateur est un administrateur
        if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== 'admin') {
            header("Location: index.php?action=login");
            exit;
        }

        // Récupérer les données nécessaires pour le tableau de bord
        $adminModel = new AdminModel($this->pdo);
        $orders = $adminModel->getAllOrders();
        $users = $adminModel->getAllUsers();

        require 'views/admin_dashboard.php';
    }

    // Modifier un utilisateur
    public function editUser()
    {
        // Vérifier si l'utilisateur est un administrateur
        if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== 'admin') {
            header("Location: index.php?action=login");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = $_POST['user_id'];
            $username = trim($_POST['username']);
            $email = trim($_POST['email']);

            if (!empty($username) && !empty($email)) {
                $adminModel = new AdminModel($this->pdo);
                $adminModel->updateUser($userId, $username, $email);
                header("Location: index.php?action=adminDashboard");
                exit;
            } else {
                $error = "Tous les champs sont obligatoires.";
            }
        }

        $userId = $_GET['id'];
        $adminModel = new AdminModel($this->pdo);
        $user = $adminModel->getUserById($userId);

        require 'views/edit_user.php';
    }
}
?>

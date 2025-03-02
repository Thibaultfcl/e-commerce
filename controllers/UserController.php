<?php
require_once 'models/UserModel.php';
session_start();

class UserController
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    // Inscription d'un nouvel utilisateur
    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = trim($_POST['nom']);
            $email = trim($_POST['email']);
            $motDePasse = $_POST['mot_de_passe'];

            if (!empty($nom) && !empty($email) && !empty($motDePasse)) {
                $userModel = new UserModel($this->pdo);
                if ($userModel->createUser($nom, $email, $motDePasse)) {
                    header("Location: index.php?action=login");
                    exit;
                } else {
                    $error = "L'email est déjà utilisé.";
                }
            } else {
                $error = "Tous les champs sont obligatoires.";
            }
        }
        require 'views/register.php';
    }

    // Connexion d'un utilisateur
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email']);
            $motDePasse = $_POST['mot_de_passe'];

            if (!empty($email) && !empty($motDePasse)) {
                $userModel = new UserModel($this->pdo);
                $user = $userModel->getUserByEmail($email);

                if ($user && password_verify($motDePasse, $user['password'])) {
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['user_name'] = $user['username'];
                    header("Location: index.php");
                    exit;
                } else {
                    $error = "Email ou mot de passe incorrect.";
                }
            } else {
                $error = "Tous les champs sont obligatoires.";
            }
        }
        require 'views/login.php';
    }

    // Déconnexion de l'utilisateur
    public function logout()
    {
        session_destroy();
        header("Location: index.php");
    }
}

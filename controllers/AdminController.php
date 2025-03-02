<?php
// controllers/AdminController.php

require_once 'models/UserModel.php';
require_once 'models/FilmModel.php';
require_once 'config/database.php'; // Inclure la configuration pour obtenir la clé API
session_start();

class AdminController {
    private $pdo;
    private $apiKey;

    public function __construct($pdo, $apiKey) {
        $this->pdo = $pdo;
        $this->apiKey = $apiKey;
    }

    // Affiche le formulaire de connexion pour l'administrateur
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email']);
            $motDePasse = $_POST['mot_de_passe'];

            if (!empty($email) && !empty($motDePasse)) {
                $userModel = new UserModel($this->pdo);
                $user = $userModel->getUserByEmail($email);

                if ($user && password_verify($motDePasse, $user['mot_de_passe']) && $user['role'] === 'admin') {
                    $_SESSION['admin_id'] = $user['id'];
                    $_SESSION['admin_name'] = $user['nom'];
                    header("Location: index.php?action=adminDashboard");
                    exit;
                } else {
                    $error = "Email ou mot de passe incorrect.";
                }
            } else {
                $error = "Tous les champs sont obligatoires.";
            }
        }
        require 'views/admin_login.php';
    }

    // Déconnexion de l'administrateur
    public function logout() {
        session_destroy();
        header("Location: index.php?action=adminLogin");
    }

    // Affiche le tableau de bord de l'administrateur
    public function dashboard() {
        if (!isset($_SESSION['admin_id'])) {
            header("Location: index.php?action=adminLogin");
            exit;
        }
        $filmModel = new FilmModel($this->apiKey, $this->pdo);
        $films = $filmModel->getLatestFilms();
        require 'views/admin_dashboard.php';
    }

    // // Ajouter un nouveau film
    // public function addFilm() {
    //     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //         $titre = $_POST['titre'];
    //         $realisateur = $_POST['realisateur'];
    //         $categorie_id = $_POST['categorie_id'];
    //         $prix = $_POST['prix'];

    //         $filmModel = new FilmModel($this->apiKey);
    //         $filmModel->addFilm($titre, $realisateur, $categorie_id, $prix);

    //         header("Location: index.php?action=adminDashboard");
    //         exit;
    //     }
    //     require 'views/add_film.php';
    // }

    // // Modifier un film existant
    // public function editFilm() {
    //     $id = $_GET['id'] ?? 0;
    //     $filmModel = new FilmModel($this->apiKey);

    //     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //         $titre = $_POST['titre'];
    //         $realisateur = $_POST['realisateur'];
    //         $categorie_id = $_POST['categorie_id'];
    //         $prix = $_POST['prix'];

    //         $filmModel->updateFilm($id, $titre, $realisateur, $categorie_id, $prix);

    //         header("Location: index.php?action=adminDashboard");
    //         exit;
    //     }

    //     $film = $filmModel->getFilmById($id);
    //     require 'views/edit_film.php';
    // }

    // // Supprimer un film
    // public function deleteFilm() {
    //     $id = $_GET['id'] ?? 0;
    //     $filmModel = new FilmModel($this->apiKey);
    //     $filmModel->deleteFilm($id);

    //     header("Location: index.php?action=adminDashboard");
    //     exit;
    // }
}
?>
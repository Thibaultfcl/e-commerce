<?php
// controllers/HomeController.php

require_once 'models/FilmModel.php';
require_once 'config/database.php'; // Inclure la configuration pour obtenir la clé API
session_start();

class HomeController
{
    private $pdo;
    private $apiKey;

    public function __construct($pdo, $apiKey)
    {
        $this->pdo = $pdo;
        $this->apiKey = $apiKey;
    }

    // Affiche la page d'accueil avec les derniers films
    public function index()
    {
        $filmModel = new FilmModel($this->apiKey);
        $films = $filmModel->getLatestFilms();
        require 'views/home.php';
    }

    public function search()
    {
        $query = $_GET['query'] ?? '';

        if (!empty($query)) {
            $filmModel = new FilmModel($this->apiKey);
            $films = $filmModel->searchFilms($query);
        } else {
            $films = [];
        }

        require 'views/search_results.php';
    }

    public function addToCart()
    {

        // Vérifier si l'utilisateur est connecté
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?action=login");
            exit;
        }

        $filmId = $_GET['id'];
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
        if (isset($_SESSION['cart'][$filmId])) {
            $_SESSION['cart'][$filmId]++;
        } else {
            $_SESSION['cart'][$filmId] = 1;
        }

        header("Location: index.php?action=showCart");
        exit;
    }


    public function showCart()
    {

        // Vérifier si l'utilisateur est connecté
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?action=login");
            exit;
        }

        $cart = $_SESSION['cart'] ?? [];
        require 'views/cart.php';
    }


    // Supprime un film du panier
    public function removeFromCart()
    {
        $filmId = $_GET['id'];
        if (isset($_SESSION['cart'][$filmId])) {
            unset($_SESSION['cart'][$filmId]);
        }
        header("Location: index.php?action=showCart");
        exit;
    }

    public function checkout()
    {

        // Vérifier si l'utilisateur est connecté
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?action=login");
            exit;
        }

        $cart = $_SESSION['cart'] ?? [];

        if (empty($cart)) {
            header("Location: index.php?action=showCart");
            exit;
        }

        $userId = $_SESSION['user_id'];
        $total = 0;
        $filmModel = new FilmModel($this->apiKey);

        foreach ($cart as $filmId => $quantity) {
            $film = $filmModel->getFilmById($filmId);
            $total += $film['prix'] * $quantity;
        }

        // Debugging statement to check userId
        error_log("User ID: " . $userId);

        // Check if user exists in the user table
        $stmt = $this->pdo->prepare("SELECT id FROM users WHERE id = :userId");
        $stmt->execute(['userId' => $userId]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            die("User ID does not exist in the user table.");
        }

        // Insérer la commande dans la table command
        $stmt = $this->pdo->prepare("INSERT INTO command (user_id, total_price) VALUES (:userId, :total)");
        $stmt->execute(['userId' => $userId, 'total' => $total]);
        $orderId = $this->pdo->lastInsertId();

        // Insérer les articles commandés
        foreach ($cart as $filmId => $quantity) {
            $film = $filmModel->getFilmById($filmId);
            $stmt = $this->pdo->prepare("INSERT INTO product_relation (command_id, product_id, quantity, price) VALUES (:orderId, :movieId, :quantity, :price)");
            $stmt->execute([
                'orderId'   => $orderId,
                'movieId'   => $filmId,
                'quantity'  => $quantity,
                'price'      => $film['prix']
            ]);
        }

        // Vider le panier après l'achat
        unset($_SESSION['cart']);
        header("Location: index.php?action=orderHistory");
        exit;
    }


    // Affiche l'historique des commandes de l'utilisateur
    public function orderHistory()
    {
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?action=login");
            exit;
        }
        $stmt = $this->pdo->prepare("SELECT * FROM command WHERE user_id = :userId ORDER BY created_at DESC");
        $stmt->execute(['userId' => $_SESSION['user_id']]);
        $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
        require 'views/order_history.php';
    }
}

<?php
// controllers/HomeController.php

require_once 'models/FilmModel.php';
session_start();

class HomeController
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    // Affiche la page d'accueil avec les derniers films
    public function index()
    {
        $filmModel = new FilmModel($this->pdo);
        $films = $filmModel->getLatestFilms();
        require 'views/home.php';
    }

    public function search()
    {
        $query = $_GET['query'] ?? '';

        if (!empty($query)) {
            $filmModel = new FilmModel($this->pdo);
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
        $filmModel = new FilmModel($this->pdo);

        foreach ($cart as $filmId => $quantity) {
            $film = $filmModel->getFilmById($filmId);
            $total += $film['prix'] * $quantity;
        }

        // Insérer la commande dans la table orders
        $stmt = $this->pdo->prepare("INSERT INTO orders (user_id, total) VALUES (:userId, :total)");
        $stmt->execute(['userId' => $userId, 'total' => $total]);
        $orderId = $this->pdo->lastInsertId();

        // Insérer les articles commandés
        foreach ($cart as $filmId => $quantity) {
            $film = $filmModel->getFilmById($filmId);
            $stmt = $this->pdo->prepare("INSERT INTO order_items (order_id, movie_id, quantite, prix) VALUES (:orderId, :movieId, :quantite, :prix)");
            $stmt->execute([
                'orderId'   => $orderId,
                'movieId'   => $filmId,
                'quantite'  => $quantity,
                'prix'      => $film['prix']
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
        $stmt = $this->pdo->prepare("SELECT * FROM orders WHERE user_id = :userId ORDER BY date DESC");
        $stmt->execute(['userId' => $_SESSION['user_id']]);
        $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
        require 'views/order_history.php';
    }
}

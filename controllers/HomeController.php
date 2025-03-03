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

        header("Location: index.php?action=index");
        exit;
    }


    public function showCart()
    {
        // Vérifier si l'utilisateur est connecté
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?action=login");
            exit;
        }

        $filmModel = new FilmModel($this->apiKey);
        $films = [];

        if (!empty($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $filmId => $quantity) {
                $film = $filmModel->getFilmById($filmId);
                $film['quantity'] = $quantity;
                $films[] = $film;
            }
        }
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
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?action=login");
            exit;
        }

        $cart = $_SESSION['cart'] ?? [];

        if (empty($cart)) {
            header("Location: index.php?action=showCart");
            exit;
        }

        // Rediriger vers le formulaire de paiement
        header("Location: index.php?action=paymentForm");
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

    public function orderDetail()
    {
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?action=login");
            exit;
        }

        $orderId = $_GET['id'] ?? 0;

        // Récupérer les détails de la commande
        $stmt = $this->pdo->prepare("SELECT * FROM product_relation WHERE command_id = :orderId");
        $stmt->execute(['orderId' => $orderId]);
        $orderDetails = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $filmModel = new FilmModel($this->apiKey);
        foreach ($orderDetails as &$detail) {
            $film = $filmModel->getFilmById($detail['product_id']);
            $detail['film'] = $film;
        }

        require 'views/order_detail.php';
    }

    public function paymentForm()
    {
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?action=login");
            exit;
        }
        require 'views/payment.php';
    }

    public function processPayment()
    {
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?action=login");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $cardName = trim($_POST['card_name']);
            $cardNumber = trim($_POST['card_number']);
            $expiryDate = trim($_POST['expiry_date']);
            $cvv = trim($_POST['cvv']);

            if (!empty($cardName) && !empty($cardNumber) && !empty($expiryDate) && !empty($cvv)) {
                // Insérer les coordonnées bancaires dans la base de données
                $stmt = $this->pdo->prepare("INSERT INTO payment_details (user_id, card_name, card_number, expiry_date, cvv) VALUES (:userId, :cardName, :cardNumber, :expiryDate, :cvv)");
                $stmt->execute([
                    'userId' => $_SESSION['user_id'],
                    'cardName' => $cardName,
                    'cardNumber' => $cardNumber,
                    'expiryDate' => $expiryDate,
                    'cvv' => $cvv
                ]);

                // Rediriger vers la méthode placeOrder pour insérer la commande
                header("Location: index.php?action=placeOrder");
                exit;
            } else {
                $error = "Tous les champs sont obligatoires.";
                require 'views/payment_form.php';
            }
        }
    }

    public function placeOrder()
    {
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
}

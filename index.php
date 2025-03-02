<?php
// index.php

require_once 'config/database.php'; // La connexion PDO est créée ici

$action = $_GET['action'] ?? 'index';

switch ($action) {
    case 'index':
        require_once 'controllers/HomeController.php';
        $controller = new HomeController($pdo);
        $controller->index();
        break;
    case 'search':
        require_once 'controllers/HomeController.php';
        $controller = new HomeController($pdo);
        $controller->search();
        break;

    case 'filmDetail':
        require_once 'controllers/FilmController.php';
        $controller = new FilmController($pdo);
        $controller->filmDetail();
        break;
    case 'filmsByCategory':
        require_once 'controllers/FilmController.php';
        $controller = new FilmController($pdo);
        $controller->filmsByCategory();
        break;
    case 'addToCart':
        require_once 'controllers/HomeController.php';
        $controller = new HomeController($pdo);
        $controller->addToCart();
        break;
    case 'showCart':
        require_once 'controllers/HomeController.php';
        $controller = new HomeController($pdo);
        $controller->showCart();
        break;
    case 'removeFromCart':
        require_once 'controllers/HomeController.php';
        $controller = new HomeController($pdo);
        $controller->removeFromCart();
        break;
    case 'register':
        require_once 'controllers/UserController.php';
        $controller = new UserController($pdo);
        $controller->register();
        break;

    case 'login':
        require_once 'controllers/UserController.php';
        $controller = new UserController($pdo);
        $controller->login();
        break;

    case 'logout':
        require_once 'controllers/UserController.php';
        $controller = new UserController($pdo);
        $controller->logout();
        break;

    case 'checkout':
        require_once 'controllers/HomeController.php';
        $controller = new HomeController($pdo);
        $controller->checkout();
        break;

    case 'orderHistory':
        require_once 'controllers/HomeController.php';
        $controller = new HomeController($pdo);
        $controller->orderHistory();
        break;
    default:
        echo "Action non définie";
}

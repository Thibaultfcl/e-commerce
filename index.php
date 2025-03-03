<?php
// index.php

require_once 'config/database.php'; // La connexion PDO est créée ici
require_once 'config/var.php'; // La clé API est définie ici

$action = $_GET['action'] ?? 'index';

switch ($action) {
    case 'index':
        require_once 'controllers/HomeController.php';
        $controller = new HomeController($pdo, $apiKey);
        $controller->index();
        break;
    case 'search':
        require_once 'controllers/HomeController.php';
        $controller = new HomeController($pdo, $apiKey);
        $controller->search();
        break;

    case 'filmDetail':
        require_once 'controllers/FilmController.php';
        $controller = new FilmController($pdo, $apiKey);
        $controller->filmDetail();
        break;
    case 'filmsByCategory':
        require_once 'controllers/FilmController.php';
        $controller = new FilmController($pdo, $apiKey);
        $controller->filmsByCategory();
        break;
    case 'actorDetail':
        require_once 'controllers/FilmController.php';
        $controller = new FilmController($pdo, $apiKey);
        $controller->actorDetail();
        break;
    case 'addToCart':
        require_once 'controllers/HomeController.php';
        $controller = new HomeController($pdo, $apiKey);
        $controller->addToCart();
        break;
    case 'showCart':
        require_once 'controllers/HomeController.php';
        $controller = new HomeController($pdo, $apiKey);
        $controller->showCart();
        break;
    case 'removeFromCart':
        require_once 'controllers/HomeController.php';
        $controller = new HomeController($pdo, $apiKey);
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
        $controller = new HomeController($pdo, $apiKey);
        $controller->checkout();
        break;

    case 'orderHistory':
        require_once 'controllers/HomeController.php';
        $controller = new HomeController($pdo, $apiKey);
        $controller->orderHistory();
        break;
  
    case 'adminDashboard':
        require_once 'controllers/AdminController.php';
        $controller = new AdminController($pdo, $apiKey);
        $controller->dashboard();
        break;
    case 'editUser':
        require_once 'controllers/AdminController.php';
        $controller = new AdminController($pdo, $apiKey);
        $controller->editUser();
        break;
    default:
        echo "Action non définie";
}
?>

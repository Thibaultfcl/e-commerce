<?php
// controllers/FilmController.php

require_once 'models/FilmModel.php';
require_once 'config/database.php'; // Inclure la configuration pour obtenir la clé API
session_start();

class FilmController {
    private $pdo;
    private $apiKey;

    public function __construct($pdo, $apiKey) {
        $this->pdo = $pdo;
        $this->apiKey = $apiKey;
    }

    // Affiche le détail d'un film
    public function filmDetail() {
        $id = $_GET['id'] ?? 0;
        $filmModel = new FilmModel($this->apiKey);
        $film = $filmModel->getFilmById($id);
        $realisateur = $film['director'] ?? null;
        $otherFilms = $realisateur ? $filmModel->getFilmsByDirector($realisateur, $id) : [];
        require 'views/film_detail.php';
    }

    // Affiche les films d'une catégorie
    public function filmsByCategory() {
        $categoryId = $_GET['cat'] ?? 0;
        $filmModel = new FilmModel($this->apiKey);

        // Récupérer le nom de la catégorie
        $stmt = $this->pdo->prepare("SELECT nom FROM categories WHERE id = :catId");
        $stmt->execute(['catId' => $categoryId]);
        $category = $stmt->fetch(PDO::FETCH_ASSOC);

        // Récupérer les films de cette catégorie
        $films = $filmModel->getFilmsByCategory($categoryId);

        require 'views/category.php';
    }

    // Affiche les informations d'un acteur et les films dans lesquels il a joué
    public function actorDetail() {
        $id = $_GET['id'] ?? 0;
        $filmModel = new FilmModel($this->apiKey);
        $actor = $filmModel->getActorById($id);
        require 'views/actor_detail.php';
    }
}
?>

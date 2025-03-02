<?php
// controllers/FilmController.php

require_once 'models/FilmModel.php';
session_start();

class FilmController
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    // Affiche le détail d'un film
    public function filmDetail()
    {
        $id = $_GET['id'] ?? 0;
        $filmModel = new FilmModel($this->pdo);
        $film = $filmModel->getFilmById($id);
        $otherFilms = $filmModel->getFilmsByDirector($film['realisateur'], $id);
        require 'views/film_detail.php';
    }

    // Affiche les films d'une catégorie
    public function filmsByCategory()
    {
        $categoryId = $_GET['cat'] ?? 0;
        $filmModel = new FilmModel($this->pdo);

        // Récupérer le nom de la catégorie
        $stmt = $this->pdo->prepare("SELECT nom FROM categories WHERE id = :catId");
        $stmt->execute(['catId' => $categoryId]);
        $category = $stmt->fetch(PDO::FETCH_ASSOC);

        // Récupérer les films de cette catégorie
        $films = $filmModel->getFilmsByCategory($categoryId);

        require 'views/category.php';
    }
}

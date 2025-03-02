<?php
// models/FilmModel.php

class FilmModel
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    // Récupère les derniers films (limité à 10)
    public function getLatestFilms()
    {
        $stmt = $this->pdo->query("SELECT * FROM movies ORDER BY created_at DESC LIMIT 10");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Récupère un film par son ID
    public function getFilmById($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM movies WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function searchFilms($query)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM movies WHERE titre LIKE :query OR realisateur LIKE :query");
        $stmt->execute(['query' => '%' . $query . '%']);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    // Récupère les films par catégorie
    public function getFilmsByCategory($categoryId)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM movies WHERE categorie_id = :catId LIMIT 10");
        $stmt->execute(['catId' => $categoryId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Récupère d'autres films du même réalisateur (hors film courant)
    public function getFilmsByDirector($director, $excludeId)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM movies WHERE realisateur = :director AND id != :excludeId");
        $stmt->execute(['director' => $director, 'excludeId' => $excludeId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

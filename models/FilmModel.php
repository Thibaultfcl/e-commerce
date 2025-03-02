<?php
// models/FilmModel.php

class FilmModel
{
    private $apiKey;
    private $apiUrl = "https://api.themoviedb.org/3";

    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    private function fetchFromApi($endpoint, $params = [])
    {
        $url = $this->apiUrl . $endpoint . '?api_key=' . $this->apiKey . '&' . http_build_query($params);
        $response = file_get_contents($url);
        return json_decode($response, true);
    }

    // Récupère les derniers films (limité à 10)
    public function getLatestFilms()
    {
        $data = $this->fetchFromApi('/movie/now_playing', ['language' => 'fr-FR', 'page' => 1]);
        return $data['results'];
    }

    // Récupère un film par son ID
    public function getFilmById($id)
    {
        $data = $this->fetchFromApi('/movie/' . $id, ['language' => 'fr-FR']);
        return $data;
    }

    public function searchFilms($query)
    {
        $data = $this->fetchFromApi('/search/movie/' . $query, ['language' => 'fr-FR']);
        return $data['results'];
    }

    // Récupère les films par catégorie
    public function getFilmsByCategory($categoryId)
    {
        $data = $this->fetchFromApi('/discover/movie', ['with_genres' => $categoryId, 'language' => 'fr-FR']);
        return $data['results'];
    }

    // Récupère d'autres films du même réalisateur (hors film courant)
    public function getFilmsByDirector($director, $excludeId)
    {
        $data = $this->fetchFromApi('/search/person', ['query' => $director, 'language' => 'fr-FR']);
        $directorId = $data['results'][0]['id'];
        $movies = $this->fetchFromApi('/person/' . $directorId . '/movie_credits', ['language' => 'fr-FR']);
        return array_filter($movies['crew'], function ($movie) use ($excludeId) {
            return $movie['id'] != $excludeId && $movie['job'] == 'Director';
        });
    }

    // // Ajouter un nouveau film
    // public function addFilm($titre, $realisateur, $categorie_id, $prix) {
    //     $stmt = $this->pdo->prepare("INSERT INTO movies (titre, realisateur, categorie_id, prix) VALUES (:titre, :realisateur, :categorie_id, :prix)");
    //     $stmt->execute([
    //         'titre' => $titre,
    //         'realisateur' => $realisateur,
    //         'categorie_id' => $categorie_id,
    //         'prix' => $prix
    //     ]);
    // }

    // // Mettre à jour un film existant
    // public function updateFilm($id, $titre, $realisateur, $categorie_id, $prix) {
    //     $stmt = $this->pdo->prepare("UPDATE movies SET titre = :titre, realisateur = :realisateur, categorie_id = :categorie_id, prix = :prix WHERE id = :id");
    //     $stmt->execute([
    //         'id' => $id,
    //         'titre' => $titre,
    //         'realisateur' => $realisateur,
    //         'categorie_id' => $categorie_id,
    //         'prix' => $prix
    //     ]);
    // }

    // // Supprimer un film
    // public function deleteFilm($id) {
    //     $stmt = $this->pdo->prepare("DELETE FROM movies WHERE id = :id");
    //     $stmt->execute(['id' => $id]);
    // }
}

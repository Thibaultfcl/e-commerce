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
        $films = $data['results'];
        foreach ($films as &$film) {
            $film['prix'] = $film['vote_average'] > 6 ? 10 : 5;
        }
        return $films;
    }

    // Récupère un film par son ID
    public function getFilmById($id)
    {
        $data = $this->fetchFromApi('/movie/' . $id, ['language' => 'fr-FR', 'append_to_response' => 'credits']);
        if (isset($data['credits'])) {
            $data['director'] = $this->getDirectorFromCredits($data['credits']);
            $data['cast'] = $data['credits']['cast'];
        }
        $data['prix'] = $data['vote_average'] > 6 ? 10 : 5;
        return $data;
    }

    private function getDirectorFromCredits($credits)
    {
        foreach ($credits['crew'] as $crewMember) {
            if ($crewMember['job'] === 'Director') {
                return $crewMember['name'];
            }
        }
        return null;
    }

    public function searchFilms($query)
    {
        $data = $this->fetchFromApi('/search/movie', ['query' => $query, 'language' => 'fr-FR']);
        $films = $data['results'];
        foreach ($films as &$film) {
            $film['prix'] = $film['vote_average'] > 6 ? 10 : 5;
        }
        return $films;
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
        if (isset($data['results'][0])) {
            $directorId = $data['results'][0]['id'];
            $movies = $this->fetchFromApi('/person/' . $directorId . '/movie_credits', ['language' => 'fr-FR']);
            return array_filter($movies['crew'], function ($movie) use ($excludeId) {
                return $movie['id'] != $excludeId && $movie['job'] == 'Director';
            });
        }
        return [];
    }

    // Récupère les informations d'un acteur et les films dans lesquels il a joué
    public function getActorById($id)
    {
        $data = $this->fetchFromApi('/person/' . $id, ['language' => 'fr-FR', 'append_to_response' => 'movie_credits']);
        return $data;
    }

    // Récupère les films dans lesquels un acteur a joué
    public function getFilmsByActor($actorId)
    {
        $data = $this->fetchFromApi('/person/' . $actorId . '/movie_credits', ['language' => 'fr-FR']);
        return $data['cast'] ?? [];
    }
}

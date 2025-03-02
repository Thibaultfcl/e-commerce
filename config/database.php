<?php
// config/database.php
$host = 'localhost';  // Si tu utilises WAMP ou XAMPP
$dbname = 'movies_db';  // Nom de ta base de données
$username = 'root';  // Nom d'utilisateur de ta base de données (par défaut 'root')
$password = '';  // Laisser vide si tu n'as pas défini de mot de passe

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>

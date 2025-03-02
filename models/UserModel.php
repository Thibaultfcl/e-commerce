<?php
class UserModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Création d'un nouvel utilisateur avec mot de passe hashé
    public function createUser($nom, $email, $motDePasse) {
        $stmt = $this->pdo->prepare("SELECT id FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);

        if ($stmt->fetch()) {
            return false; // Email déjà utilisé
        }

        $stmt = $this->pdo->prepare("INSERT INTO users (nom, email, mot_de_passe) VALUES (:nom, :email, :motDePasse)");
        return $stmt->execute([
            'nom' => $nom,
            'email' => $email,
            'motDePasse' => password_hash($motDePasse, PASSWORD_DEFAULT)
        ]);
    }

    // Récupération d'un utilisateur par email
    public function getUserByEmail($email) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Création d'un nouvel administrateur
    public function createAdmin($nom, $email, $motDePasse) {
        $stmt = $this->pdo->prepare("SELECT id FROM admins WHERE email = :email");
        $stmt->execute(['email' => $email]);

        if ($stmt->fetch()) {
            return false; // Email déjà utilisé
        }

        $stmt = $this->pdo->prepare("INSERT INTO admins (nom, email, mot_de_passe) VALUES (:nom, :email, :motDePasse)");
        return $stmt->execute([
            'nom' => $nom,
            'email' => $email,
            'motDePasse' => password_hash($motDePasse, PASSWORD_DEFAULT)
        ]);
    }

    // Récupération d'un administrateur par email
    public function getAdminByEmail($email) {
        $stmt = $this->pdo->prepare("SELECT * FROM admins WHERE email = :email");
        $stmt->execute(['email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>

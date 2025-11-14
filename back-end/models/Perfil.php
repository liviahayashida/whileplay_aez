<?php
class Perfil {
    private $pdo;

    public function __construct() {
        require __DIR__ . '/../config/db.php';
        $this->pdo = $pdo;
    }

    public function buscarPorEmail($email) {
        $sql = "SELECT * FROM perfil WHERE email = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$email]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}


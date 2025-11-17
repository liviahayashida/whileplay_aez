<?php
require_once __DIR__ . '/../config/db.php';

class Suporte {

    private $pdo;

    public function __construct() {
        global $pdo;
        $this->pdo = $pdo;
    }

    // Busca ID pelo email
    public function buscarUsuarioIdPorEmail($email) {
        try {
            $sql = "SELECT id FROM perfil WHERE email = :email LIMIT 1";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
            return $resultado['id'] ?? null;

        } catch (PDOException $e) {
            echo "Erro ao buscar usuário: " . $e->getMessage();
            return null;
        }
    }

    // Salva suporte
    public function salvarSuporte($usuario_id, $mensagem) {
        try {
            $sql = "INSERT INTO suportes (usuario_id, mensagem, data_envio)
                    VALUES (:usuario_id, :mensagem, NOW())";

            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':usuario_id', $usuario_id);
            $stmt->bindParam(':mensagem', $mensagem);

            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Erro ao salvar suporte: " . $e->getMessage();
            return false;
        }
    }
}
?>

<?php
class Usuario {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function cadastrar($nome_completo, $username, $email, $senha) {
        $sql = "INSERT INTO perfil (nome_completo, username, email, senha) VALUES (:nome_completo, :username, :email, :senha)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':nome_completo', $nome_completo);
        $stmt->bindValue(':username', $username);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':senha', password_hash($senha, PASSWORD_DEFAULT));
        return $stmt->execute();
    }

    public function autenticar($email, $senha) {
        $sql = "SELECT * FROM perfil WHERE email = :email";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
            if (password_verify($senha, $usuario['senha'])) {
                return $usuario;
            }
        }
        return false;
    }
}
?>

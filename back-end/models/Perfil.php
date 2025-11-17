<?php
class Perfil {
    private $pdo;

    public function __construct() {
        // espera que db.php crie a variável $pdo (instância PDO)
        require __DIR__ . '/../config/db.php';
        if (!isset($pdo) || !$pdo instanceof PDO) {
            throw new Exception("PDO não encontrado em config/db.php. Verifique se \$pdo foi criado corretamente.");
        }
        $this->pdo = $pdo;
    }

    /**
     * Retorna todos os dados do perfil (array associativo) dado um email.
     * Retorna false se não encontrar ou em caso de erro.
     */
    public function buscarPorEmail(string $email) {
        try {
            $sql = "SELECT * FROM perfil WHERE email = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$email]);
            $dados = $stmt->fetch(PDO::FETCH_ASSOC);
            return $dados ?: false;
        } catch (PDOException $e) {
            // opcional: logar o erro em arquivo para debug
            // error_log("Perfil::buscarPorEmail error: " . $e->getMessage());
            return false;
        }
    }
public function buscarIdPorEmail($email) {
    $sql = "SELECT id FROM perfil WHERE email = ?";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([$email]);
    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

    return $resultado['id'] ?? null;
}


    /**
     * Atualiza o perfil pelo id.
     * Retorna true em sucesso, false caso contrário.
     */
    public function atualizar($id, $nome, $username, $bio, $email, $senha, $data, $imagem = null) {
        try {
            if ($imagem) {
                $sql = "UPDATE perfil 
                        SET nome_completo = ?, username = ?, biografia = ?, email = ?, senha = ?, data_criacao = ?, imagem = ?
                        WHERE id = ?";
                $params = [$nome, $username, $bio, $email, $senha, $data, $imagem, $id];
            } else {
                $sql = "UPDATE perfil 
                        SET nome_completo = ?, username = ?, biografia = ?, email = ?, senha = ?, data_criacao = ?
                        WHERE id = ?";
                $params = [$nome, $username, $bio, $email, $senha, $data, $id];
            }

            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute($params);
        } catch (PDOException $e) {
            // error_log("Perfil::atualizar error: " . $e->getMessage());
            return false;
        }
    }
}

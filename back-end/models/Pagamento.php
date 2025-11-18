<?php
require_once __DIR__ . '/../config/db.php';

class Pagamento {

    private $pdo;

    public function __construct() {
        global $pdo;
        $this->pdo = $pdo;
    }

    public function buscarUsuarioIdPorEmail($email) {
        $sql = "SELECT id FROM perfil WHERE email = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$email]);
        return $stmt->fetchColumn();
    }

    public function salvarPagamento($usuario_id, $codigo_identificacao, $nome_cartao, $numero_cartao, $vencimento, $codigo) {
        try {

            $sql = "INSERT INTO pagamento 
                    (usuario_id, codigo_identificacao, nome_do_cartao, numero_do_cartao, data_de_vencimento, codigo)
                    VALUES (?, ?, ?, ?, ?, ?)";

            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([
                $usuario_id,
                $codigo_identificacao,
                $nome_cartao,
                $numero_cartao,
                $vencimento,
                $codigo
            ]);

        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
            return false;
        }
    }

    public function listarPagamentos() {
        $sql = "SELECT 
                    pagamento.*,
                    personagens.nome AS produto
                FROM pagamento
                LEFT JOIN personagens 
                    ON personagens.codigo_identificacao = pagamento.codigo_identificacao
                ORDER BY pagamento.id_pagamento DESC";

        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function listarPagamentosComPersonagens() {
    global $pdo;

    $sql = "
        SELECT 
            p.id_pagamento,
            p.codigo_identificacao,
            p.status,
            p.created_at,  -- correto!

            pers.nome AS personagem_nome,
            pers.descricao AS personagem_descricao,
            pers.imagem AS personagem_imagem
        FROM pagamento p
        LEFT JOIN personagens pers
            ON p.codigo_identificacao = pers.codigo_identificacao
        ORDER BY p.created_at DESC
    ";

    $stmt = $pdo->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


}

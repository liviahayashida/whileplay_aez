<?php

require_once __DIR__ . '/../models/Pagamento.php';

class PagamentoController {

    public function showForm() {
        require __DIR__ . '/../views/pagamento_form.php';
    }

    public function savePagamento() {

        $email = $_POST['email'] ?? '';
        $codigo_identificacao = $_POST['codigo_identificacao'] ?? '';
        $nome = $_POST['nome_cartao'] ?? '';
        $numero = $_POST['numero_cartao'] ?? '';
        $vencimento = $_POST['data_vencimento'] ?? '';
        $codigo = $_POST['codigo'] ?? '';

        $pagamento = new Pagamento();

        // Buscar ID do usuário pelo e-mail
        $usuario_id = $pagamento->buscarUsuarioIdPorEmail($email);

        if (!$usuario_id) {
            die("Erro: Email não existe no banco.");
        }

        // Salvar pagamento
        $salvo = $pagamento->salvarPagamento(
            $usuario_id,
            $codigo_identificacao,
            $nome,
            $numero,
            $vencimento,
            $codigo
        );

        if ($salvo) {
            // redirecionamento correto
            header("Location: /GitHub/whileplay_aez/whileplay_aez/back-end/public/list-pagamentos");
            exit;
        }

        die("Erro ao salvar pagamento.");
    }

    public function listPagamentos() {
        $pagamento = new Pagamento();
        
        // LISTA JÁ VEM COM JOIN PERSONAGENS!!
        $pagamentos = $pagamento->listarPagamentosComPersonagens();
        
        require __DIR__ . '/../views/pagamento_list.php';
    }
}

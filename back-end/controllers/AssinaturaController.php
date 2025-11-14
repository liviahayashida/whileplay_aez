<?php
require_once __DIR__ . '/../config/db.php';

class AssinaturaController {

    // MOSTRAR FORMULÁRIO
    public function showForm() {
    session_start();

    // Quando tentar acessar o formulário, salva onde deve voltar após login
    $_SESSION['redirect_after_login'] = "/GitHub/whileplay_aez/whileplay_aez/back-end/assinatura-form";

    require_once __DIR__ . '/../views/assinatura_form.php';
}


   public function saveAssinatura() {
    include __DIR__ . '/../config/db.php';

    // Recebe dados do formulário
    $email = $_POST['email'] ?? null;
    $cidade = $_POST['cidade'] ?? null;
    $endereco = $_POST['endereco'] ?? null;
    $cep = $_POST['cep'] ?? null;
    $cpf = $_POST['cpf'] ?? null;
    $status = $_POST['status'] ?? 'ativa';
    $data_assinatura = $_POST['data_assinatura'] ?? null;
    $data_cancelamento = $_POST['data_cancelamento'] ?? null;

    if (!$email) {
        die("Erro: o email é obrigatório.");
    }

    // Buscar o ID do usuário na tabela PERFIL usando o email
    $sqlUser = "SELECT id FROM perfil WHERE email = ?";
    $stmtUser = $pdo->prepare($sqlUser);
    $stmtUser->execute([$email]);
    $user = $stmtUser->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        die("Erro: Nenhum usuário encontrado com esse e-mail na tabela perfil.");
    }

    $usuario_id = $user['id'];

    // Inserir assinatura
    $sql = "INSERT INTO assinaturas 
            (usuario_id, cidade, endereco, cep, cpf, status, data_assinatura, data_cancelamento)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        $usuario_id,
        $cidade,
        $endereco,
        $cep,
        $cpf,
        $status,
        $data_assinatura ? $data_assinatura . " 00:00:00" : null,
        $data_cancelamento ? $data_cancelamento . " 00:00:00" : null
    ]);

    // REDIRECIONAMENTO APÓS SALVAR
    header("Location: /GitHub/whileplay_aez/whileplay_aez/front-end/views/homepage2_com_assinatura.html");
    exit;
}


    // LISTAR ASSINATURAS
    public function listAssinaturas() {
        include __DIR__ . '/../config/db.php';

        $stmt = $pdo->query("SELECT * FROM assinaturas");
        $assinaturas = $stmt->fetchAll(PDO::FETCH_ASSOC);

        header('Content-Type: application/json');
        echo json_encode($assinaturas);
    }

    // APAGAR ASSINATURA PELO USUÁRIO
    public function deleteAssinaturaByUsuario() {
        include __DIR__ . '/../config/db.php';

        $id = $_GET['id'] ?? null;

        if (!$id) {
            echo json_encode(['erro' => 'ID não informado']);
            return;
        }

        $sql = "DELETE FROM assinaturas WHERE usuario_id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);

        echo json_encode(['sucesso' => true]);
    }
}

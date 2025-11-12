<?php
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../models/Usuario.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome_completo = $_POST['nome_completo'] ?? '';
    $username = $_POST['username'] ?? '';
    $email = $_POST['email'] ?? '';
    $senha = password_hash($_POST['senha'] ?? '', PASSWORD_DEFAULT);

    if (!empty($nome_completo) && !empty($username) && !empty($email) && !empty($senha)) {
        $sql = "INSERT INTO perfil (nome_completo, username, email, senha, status, data_criacao)
                VALUES (:nome_completo, :username, :email, :senha, 'ativo', NOW())";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':nome_completo', $nome_completo);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':senha', $senha);

        try {
            $stmt->execute();
            echo "✅ Cadastro realizado com sucesso!";
            header("Location: ../front-end/login.html");
            exit;
        } catch (PDOException $e) {
            echo "❌ Erro ao cadastrar: " . $e->getMessage();
        }
    } else {
        echo "⚠️ Todos os campos são obrigatórios.";
    }
}


// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     $usuario = new Usuario($pdo);

//     $nome = $_POST['nome_completo'] ?? '';
//     $username = $_POST['username'] ?? '';
//     $email = $_POST['email'] ?? '';
//     $senha = $_POST['senha'] ?? '';

//     // Impede campos vazios
//     if (empty($nome) || empty($username) || empty($email) || empty($senha)) {
//         header('Location: http://localhost/GitHub/whileplay_aez/whileplay_aez/front-end/views/cadastro.html?erro=campos');
//         exit;
//     }

//     $resultado = $usuario->cadastrar($nome, $username, $email, $senha);

//     if ($resultado === true) {
//         header('Location: http://localhost/GitHub/whileplay_aez/whileplay_aez/front-end/views/login.html?success=cadastro');
//         exit;
//     } elseif ($resultado === "email_duplicado") {
//         header('Location: http://localhost/GitHub/whileplay_aez/whileplay_aez/front-end/views/cadastro.html?erro=email');
//         exit;
//     } else {
//         header('Location: http://localhost/GitHub/whileplay_aez/whileplay_aez/front-end/views/cadastro.html?erro=desconhecido');
//         exit;
//     }
// }
?>

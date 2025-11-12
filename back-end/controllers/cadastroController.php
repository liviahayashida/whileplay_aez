<?php
require_once '../config/db.php';
require_once '../models/Usuario.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = new Usuario($pdo);

    $nome = $_POST['nome_completo'] ?? '';
    $username = $_POST['username'] ?? '';
    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';

    if ($usuario->cadastrar($nome, $username, $email, $senha)) {
        header('Location: ../../front-end/views/login.html?msg=cadastrado');
        exit;
    } else {
        echo "Erro ao cadastrar usuário.";
    }
}
?>

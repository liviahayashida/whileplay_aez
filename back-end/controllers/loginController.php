<?php
session_start();
require_once '../config/db.php';
require_once '../models/Usuario.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = new Usuario($pdo);

    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';

    $autenticado = $usuario->autenticar($email, $senha);

    if ($autenticado) {
        $_SESSION['user_id'] = $autenticado['id'];
        $_SESSION['usuario'] = $autenticado;

        header('Location: http://localhost/GitHub/whileplay_aez/whileplay_aez/front-end/homepage2_com_login.html');
        exit;
    } else {
        header('Location: http://localhost/GitHub/whileplay_aez/whileplay_aez/front-end/views/login.html?erro=invalido');
        exit;
    }
}

?>

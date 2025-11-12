<?php
session_start();
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../models/Usuario.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = new Usuario($pdo);

    $email = trim($_POST['email'] ?? '');
    $senha = trim($_POST['senha'] ?? '');

    if (empty($email) || empty($senha)) {
        header('Location: http://localhost/GitHub/whileplay_aez/whileplay_aez/front-end/views/login.html?erro=campos');
        exit;
    }

    $autenticado = $usuario->autenticar($email, $senha);

    if ($autenticado) {
        $_SESSION['user_id'] = $autenticado['id'];
        $_SESSION['usuario'] = $autenticado;

        header('Location: http://localhost/GitHub/whileplay_aez/whileplay_aez/front-end/views/homepage2_com_login.html');
        exit;
    } else {
        header('Location: http://localhost/GitHub/whileplay_aez/whileplay_aez/front-end/views/login.html?erro=invalido');
        exit;
    }
}
?>

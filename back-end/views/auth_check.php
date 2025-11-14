<?php
session_start();

if (!isset($_SESSION['user_id'])) {

    // Registra o destino após o login
    if (!isset($_SESSION['redirect_after_login'])) {
        $_SESSION['redirect_after_login'] = $_SERVER['REQUEST_URI'];
    }

    header('Location: /GitHub/whileplay_aez/whileplay_aez/back-end/login');
    exit();
}
?>

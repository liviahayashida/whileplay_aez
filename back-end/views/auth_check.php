<?php
session_start();

// Se o usuário não estiver logado, redireciona para a página de login
if (!isset($_SESSION['user_id'])) {
    header('Location: /GitHub/whileplay_aez/whileplay_aez/back-end/login');
    exit();
}
?>

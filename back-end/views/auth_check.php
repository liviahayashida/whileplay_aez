<?php
session_start();

// ROTAS LIBERADAS (não exigem login)
$rotas_livres = [
    "/assinatura-form",
    "/save-assinatura",
    "/homepage2_com_assinatura"
];

$rota_atual = $_SERVER['REQUEST_URI'];

// Se for rota livre → libera
foreach ($rotas_livres as $rota) {
    if (str_contains($rota_atual, $rota)) {
        return;
    }
}

// Se não estiver logado → manda para login
if (!isset($_SESSION['user_id'])) {

    $_SESSION['redirect_after_login'] = $rota_atual;

    header("Location: /GitHub/whileplay_aez/whileplay_aez/back-end/login");
    exit();
}
?>

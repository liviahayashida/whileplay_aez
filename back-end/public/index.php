<?php
require_once __DIR__ . '/../controllers/AssinaturaController.php';

// Captura o caminho da URL
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$basePath = '/GitHub/whileplay_aez/whileplay_aez/back-end/public';

$rota = str_replace($basePath, '', $uri);

switch ($rota) {
    case '/assinatura-form':
        (new AssinaturaController())->showForm();
        break;

    case '/save-assinatura':
        (new AssinaturaController())->saveAssinatura();
        break;

    case '/list-assinaturas':
        (new AssinaturaController())->listAssinaturas();
        break;

    case '/delete-assinatura':
        (new AssinaturaController())->deleteAssinaturaByUsuario();
        break;

    default:
        header('Content-Type: application/json');
        echo json_encode([
            'error' => 'Página não encontrada',
            'uri_recebida' => $uri,
            'rota_calculada' => $rota,
            'timestamp' => date('Y-m-d H:i:s')
        ]);
        break;
}

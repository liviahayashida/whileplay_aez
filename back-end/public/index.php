<?php
require_once __DIR__ . '/../controllers/AssinaturaController.php';

// Captura o caminho da URL
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$basePath = '/GitHub/whileplay_aez/whileplay_aez/back-end/public';

$rota = str_replace($basePath, '', $uri);

switch ($rota) {
    //CADASTRO
    case '/save-cadastro':
    require_once __DIR__ . '/../controllers/CadastroController.php';
    break;

    //PUBLICAR
    case '/update-publicar':
    require_once __DIR__ . '/../controllers/PublicarController.php';
    (new PublicarController())->updatePublicar();
    break;


    case '/delete-publicar':
    require_once __DIR__ . '/../controllers/PublicarController.php';

    $id = $_POST['id'] ?? $_GET['id'] ?? null;
    (new PublicarController())->deletePublicarById($id);
    break;

    case '/publicar-form':
    require_once __DIR__ . '/../controllers/PublicarController.php';
    (new PublicarController())->showForm();
    break;

    case '/list-publicar':
    require_once __DIR__ . '/../controllers/PublicarController.php';
    (new PublicarController())->listPublicars();
    break;

    case '/save-publicar':
    require_once __DIR__ . '/../controllers/PublicarController.php';
    (new PublicarController())->savePublicar();
    break;

    //ASSINATURA
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
    // case '/home':
    //     require_once '../../front-end/views/homepage1.html';
    //     break;

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

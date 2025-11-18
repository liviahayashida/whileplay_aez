<?php
require_once __DIR__ . '/../controllers/AssinaturaController.php';
require_once __DIR__ . '/../controllers/PagamentoController.php';


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

        // === SUPORTE ===

    case '/suporte':
        require_once __DIR__ . '/../controllers/SuporteController.php';
        (new SuporteController())->showForm();
        break;

    case '/save-suporte':
        require_once __DIR__ . '/../controllers/SuporteController.php';
        (new SuporteController())->saveSuporte();
        break;

    
        // === PERFIL ===
        case '/perfil/atualizar':
    require_once __DIR__ . '/../controllers/PerfilController.php';
    $controller = new PerfilController();
    $controller->atualizar();
    break;

    //Pagamento
            case '/pagamento-form':
    (new PagamentoController())->showForm();
    break;

case '/save-pagamento':
    (new PagamentoController())->savePagamento();
    break;

case '/list-pagamentos':
    (new PagamentoController())->listPagamentos();
    break;


}

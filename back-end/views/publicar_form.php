<?php
require_once __DIR__ . '/../models/Perfil.php';
require_once __DIR__ . '/../models/Publicar.php';

$publicar = new Publicar();
$perfil = new Perfil(); // modelo que acessa tabela "perfil"

// Handle POST create/update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $post = $_POST;
    $id = !empty($post['id']) ? (int)$post['id'] : null;

    // Buscar usuario_id pelo email
    $email = trim($post['email'] ?? '');
    $usuario = $perfil->buscarPorEmail($email);

    if (!$usuario) {
        echo '<p style="color:red">Erro: Nenhum usuário encontrado com este email.</p>';
        exit;
    }

    $usuario_id = $usuario['id'];

    $dados = [
        'usuario_id' => $usuario_id,
        'titulo' => $post['titulo'] ?? null,
        'sinopse' => $post['sinopse'] ?? null,
        'tipo' => $post['tipo'] ?? null,
        'arquivo_url' => $post['arquivo_url'] ?? null,
        'publicado' => isset($post['publicado']) ? (int)$post['publicado'] : 1,
        'status' => $post['status'] ?? 'rascunho'
    ];

    try {
        if ($id) {
            $publicar->atualizar($id, $dados);
        } else {
            $publicar->criar($dados);
        }
    } catch (Exception $e) {
        echo '<p style="color:red">Erro ao salvar publicação: ' . htmlspecialchars($e->getMessage()) . '</p>';
        exit;
    }

    // Redireciona para a lista (arquivo real)
    header('Location: /GitHub/whileplay_aez/whileplay_aez/back-end/views/publicar_list.php');
    exit;
}

// If editing, load item
$editing = false;
$item = null;
if (isset($_GET['id'])) {
    $editing = true;
    $item = $publicar->buscarPorId((int)$_GET['id']);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $editing ? 'Editar Publicação' : 'Nova Publicação'; ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Adamina&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">

    <style>
        /* CSS Base - Adaptado da sua referência */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: "Roboto", sans-serif;
            font-size: 16px;
            background-color: #222222;
            color: #fff;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        header {
            width: 100%;
        }
        .header-container {
            background-image: url('../../front-end/public/MEDIA/imagens/background.png');
            background-color: #333; 
            background-size: cover;
            background-position: center;
            padding: 40px 0;
            width: 100%;
        }
        .navbar {
            display: flex;
            justify-content: space-around;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
            padding: 0 20px;
        }
        .navbar a {
            color: rgb(255, 255, 255);
            text-decoration: none;
            font-weight: bold;
            font-size: 18px;
            padding: 10px 15px;
            transition: background 0.3s, color 0.3s;
        }
        .navbar a:hover {
            background-color: rgba(255, 255, 255, 0.2);
            border-radius: 8px;
        }
        /* BARRA DE PESQUISA */
        .search-box {
          background: white;
          border-radius: 30px;
          padding: 10px 15px;
          display: flex;
          align-items: center;
        }

        .search-box input {
          border: none;
          outline: none;
          padding: 8px;
          font-size: 16px;
          font-family: 'Poppins', sans-serif;
        }

        .search-box span {
          font-size: 18px;
          cursor: pointer;
          margin-left: 8px;
        }
        .profile-icon {
            background-color: white;
            color: #007bff;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            transition: background 0.3s, transform 0.2s;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }
        .profile-icon:hover {
            background-color: #e0e0e0;
            transform: scale(1.1);
        }
        .profile-icon .material-icons {
            font-size: 24px;
        }
        .profile-dropdown {
            position: relative;
            display: inline-block;
        }
        .dropdown-content {
            display: none;
            position: absolute;
            right: 0;
            background-color: white;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 10;
            border-radius: 8px;
            margin-top: 10px;
        }
        .dropdown-content a {
            color: #333 !important;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            text-align: left;
            font-size: 16px;
        }
        .dropdown-content a:hover {
            background-color: #f1f1f1;
            border-radius: 0;
        }
        .profile-dropdown:hover .dropdown-content {
            display: block;
        }
        .verified-badge {
            position: absolute;
            bottom: -5px;
            right: -5px;
            background-color: #FFD700;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            border: 2px solid white;
        }
        .verified-badge .material-icons {
            font-size: 14px;
            color: #333;
        }


        /* ESTILOS DO FORMULÁRIO (Main Content) */
        main {
            flex-grow: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px 20px;
        }
        .form-panel {
            background: rgb(63, 63, 63);
            width: 100%;
            max-width: 560px;
            padding: 40px 45px;
            border-radius: 20px; 
            border: 1px solid #ccc;
            box-shadow: 0 8px 20px rgba(0,0,0,0.4);
            color: white;
        }

        .form-panel h1 {
            color: white;
            text-align: center;
            margin-top: 0;
            margin-bottom: 30px;
            font-size: 32px;
            font-family: 'Adamina', serif;
            text-transform: none;
        }
        
        /* Estilos dos campos */
        label {
            color: #ccc; 
            font-weight: bold;
            font-size: 14px;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            display: block;
            margin-top: 15px;
            margin-bottom: 8px;
        }
        
        input[type="email"],
        input[type="text"],
        textarea,
        select {
            width: 100%;
            padding: 14px;
            background-color: #3a3a3a;
            border: 1px solid #5c5c5c;
            color: #f3f3f3;
            border-radius: 8px;
            font-size: 16px;
            transition: all .2s ease;
            margin-bottom: 15px; 
        }
        
        input:focus,
        select:focus,
        textarea:focus {
            background-color: #454545;
            border-color: #007bff; 
            box-shadow: 0 0 8px rgba(0,123,255,0.4);
        }

        input::placeholder,
        textarea::placeholder {
            color: #c7c7c7;
        }

        /* Estilo para a mensagem de erro PHP */
        .error-message {
            background: #ffcccc;
            color: #cc0000;
            border: 1px solid #cc0000;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 15px;
            text-align: center;
        }
        
        /* Ações/Botões */
        .actions { 
            display:flex; 
            gap:15px; 
            align-items:center; 
            margin-top: 25px;
        }

        .button-submit,
        a.button-like {
            padding: 14px 25px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 700;
            text-transform: uppercase;
            font-size: 15px;
            transition: 0.3s;
            cursor: pointer;
            box-shadow: 0 4px 6px rgba(0,0,0,0.2);
            border: none;
            flex-grow: 1;
            text-align: center;
        }

        /* Botão Salvar */
        .button-submit { 
            background-color: #007bff; 
            color: white; 
        }
        .button-submit:hover {
            background-color: #0056b3;
            transform: scale(1.02);
        }

        /* Botão Voltar/Cancelar */
        a.button-like {
            background-color: #5a6268; 
            color: white; 
        }
        a.button-like:hover {
            background-color: #4e555b;
            transform: scale(1.02);
        }

      /* RODAPÉ */
    .rodape {
        display: flex;
        justify-content: space-around;
        align-items: flex-start;
        padding: 40px;
        background-color: #1e1e1e;
        color: #ccc;
        flex-wrap: wrap;
        gap: 30px;
    }

    .rodape div {
        flex: 1;
        min-width: 200px;
    }

    .rodape h1 {
        font-size: 20px;
        margin-bottom: 10px;
    }

    .rodape a {
        display: block;
        color: #247fe6;
        text-decoration: none;
        margin: 5px 0;
    }

    .rodape a:hover {
        text-decoration: underline;
    }

    .rodape img {
        width: 50px;
        height: 50px;
        margin-right: 10px;
    }

    .contato {
        width: 100%;
        text-align: center;
        margin-top: 20px;
        font-size: 14px;
    }
    </style>
</head>
<body>
    <header>
        <div class="header-container">
            <div class="navbar">
                <div class="search-box">
                    <input type="text" id="searchInput" placeholder="Pesquisar">
                    <span onclick="clearSearch()">❌</span>
                </div>

                <a href="../../front-end/views/sobrenos_com_assinatura.html">Sobre Nós</a>
                <a href="../../front-end/views/premios_com_assinatura.html">Prêmios</a>
                <a href="../../front-end/views/roteiros_com_assinatura.html">Roteiro</a>
                <a href="../../front-end/views/homepage2_com_assinatura.html">Homepage</a>
                <a href="pagamento_list.php">Biblioteca</a>
                <a href="../../front-end/views/personagens_com_assinatura.html">Personagens</a>
                <a href="publicar_form.php">Publicar</a>

                <div class="profile-dropdown">
                    <div class="profile-icon" onclick="window.location.href='../../back-end/views/perfil_form.php'">
                        <span class="material-icons">person</span>
                        <div class="verified-badge">
                            <span class="material-icons">verified</span>
                        </div>
                    </div>
                    <div class="dropdown-content">
                        <a href="#" class="premium-option">
                            <span class="material-icons" style="font-size: 18px; vertical-align: middle; margin-right: 5px; color: #007bff;">verified</span>
                            Membro Premium
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <script>
            function clearSearch() {
                document.getElementById('searchInput').value = '';
            }
        </script>
    </header>
    
    <main>
        <div class="form-panel">
            <h1><?php echo $editing ? 'Editar Publicação' : 'Nova Publicação'; ?></h1>

            <form method="post" action="/GitHub/whileplay_aez/whileplay_aez/back-end/public/save-publicar">

                <?php if ($editing && isset($item['id'])): ?>
                    <input type="hidden" name="id" value="<?php echo (int)$item['id']; ?>">
                <?php endif; ?>

                <label for="email">Seu Email</label>
                <input type="email" name="email" id="email" placeholder="Digite seu Email" required
                       value="<?php echo $editing ? htmlspecialchars($item['email'] ?? '') : ''; ?>" />

                <label for="titulo">Título</label>
                <input type="text" name="titulo" id="titulo" placeholder="Título da sua obra" required
                       value="<?php echo $editing ? htmlspecialchars($item['titulo'] ?? '') : ''; ?>" />

                <label for="sinopse">Sinopse</label>
                <textarea name="sinopse" id="sinopse" placeholder="Descreva brevemente sua obra"><?php
                    echo $editing ? htmlspecialchars($item['sinopse'] ?? '') : ''; ?></textarea>

                <label for="tipo">Tipo</label>
                <select name="tipo" id="tipo">
                    <option value="roteiro" <?php echo ($editing && ($item['tipo'] ?? '') === 'roteiro') ? 'selected' : ''; ?>>Roteiro</option>
                    <option value="personagem" <?php echo ($editing && ($item['tipo'] ?? '') === 'personagem') ? 'selected' : ''; ?>>Personagem</option>
                </select>

                <label for="arquivo_url">URL do Arquivo</label>
                <input type="text" name="arquivo_url" id="arquivo_url" placeholder="URL do arquivo (opcional)"
                       value="<?php echo $editing ? htmlspecialchars($item['arquivo_url'] ?? '') : ''; ?>" />

                <label for="status">Status</label>
                <select name="status" id="status">
                    <option value="rascunho" <?php echo ($editing && ($item['status'] ?? '') === 'rascunho') ? 'selected' : ''; ?>>Rascunho</option>
                    <option value="publicado" <?php echo ($editing && ($item['status'] ?? '') === 'publicado') ? 'selected' : ''; ?>>Publicado</option>
                    <option value="rejeitado" <?php echo ($editing && ($item['status'] ?? '') === 'rejeitado') ? 'selected' : ''; ?>>Rejeitado</option>
                </select>

                <input type="hidden" name="publicado" value="1" />

                <div class="actions">
                    <button type="submit" class="button-submit">Salvar</button>

                    <a class="button-like" href="/GitHub/whileplay_aez/whileplay_aez/front-end/views/homepage2_com_assinatura.html">
                        Voltar
                    </a>
                </div>
            </form>
        </div>
    </main>

    <div class="rodape">
      <div class="producao">
        <h1>Produtores</h1>
        <p><br>Diego Alves Gomes<br>Geovana Clemente Cruz<br>Livia Mayumi Hayashida<br>Victor do Vale Souza</p>
      </div>
      <div class="suporte">
        <h1>Precisa de Suporte?</h1>
        <a href="https://www.google.com.br/">E-mail</a>
        <a href="../../back-end/views/suporte_form.php">Fale Conosco</a>
      </div>

      <div class="siga-nos">
      <h1>Siga-nos!</h1>
      <a href="https://www.instagram.com/"><img src="../../front-end/public/MEDIA/imagens/instagram.png" alt="Instagram"></a>
      <a href="https://www.tiktok.com/login?lang=pt-BR&redirect_url=https%3A%2F%2Fwww.tiktok.com%2Fupload%3Flang%3Dpt-BR"><img src="../../front-end/public/MEDIA/imagens/tiktok.png" alt="TikTok"></a>
    </div>

      <p class="contato">Contato: aez.whileplay@gmail.com</p>
    </div>
</body>
</html>